<?php

namespace CedricZiel\FinTSScraper\De;

use CedricZiel\FinTSScraper\De\Model\FinTSDataSheet;
use CedricZiel\FinTSScraper\De\Model\ListItem;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\DomCrawler\Crawler;

class Scraper implements ScraperInterface
{
    const SEARCH_BASE_URL = 'https://www.hbci-zka.de/institute/institut_select.php';

    /**
     * @var Client
     */
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
        ));
        $this->client->setClient($guzzleClient);
    }

    /**
     * @param string $blz
     * @return ListItem[]
     */
    public function scrapeByBlz(string $blz): array
    {
        $items = $this->scrapeList([
            'blz_search' => $blz,
        ]);

        return array_filter($items);
    }

    /**
     * @param array $parameters
     * @return array
     */
    private function scrapeList(array $parameters = []): array
    {
        $crawler = $this->client->request('GET', self::SEARCH_BASE_URL);
        $form = $crawler->selectButton('Abschicken')->form($parameters);

        $crawler = $this->client->submit($form);

        $rows = $crawler->filter('form[name="Bankenselektion"] table tr:nth-child(n+1)');

        $items = $rows->each(function ($row, $i) {
            if ($i === 0) {
                return null;
            }

            $item = new ListItem();
            $row->filter('td')->each(function ($node, $i) use (&$item) {
                if ($i === 0) {
                    $item->setId($node->filter('input')->first()->attr('value'));
                } elseif ($i === 1) {
                    $item->setBankNumber(trim(ltrim($node->text(), ' ')));
                } elseif ($i === 2) {
                    $item->setBankName(trim(ltrim($node->text(), ' ')));
                } elseif ($i === 3) {
                    $item->setLocation(trim(ltrim($node->text(), ' ')));
                }

                return $item;
            });

            return $item;
        });

        return $items;
    }

    /**
     * @param string $name
     * @param string $location
     * @return ListItem[]
     */
    public function scrapeByNameAndLocation(string $name, $location = null): array
    {
        $items = $this->scrapeList([
            'inst_search' => $name,
            'ort_search' => $location ?: '',
            'verband' => 'alle',
        ]);

        return array_filter($items);
    }

    /**
     * @param ListItem $listItem
     * @return FinTSDataSheet
     */
    public function scrapeItem(ListItem $listItem): FinTSDataSheet
    {
        $crawler = $this->client->request('GET', self::SEARCH_BASE_URL);
        $form = $crawler->selectButton('Abschicken')->form([
            'blz_search' => $listItem->getBankNumber(),
        ]);

        $crawler = $this->client->submit($form);

        $form = $crawler->selectButton('Abschicken')->form([
            'blz_auswahl_radio' => $listItem->getId(),
        ]);

        $crawler = $this->client->submit($form);

        $infos = [];
        $crawler->filter('table')->each(function ($table, $i) use (&$infos) {
            if ($i !== 1) {
                return null;
            }

            /** @var Crawler $hbciUrlRow */
            $hbciUrlRow = $table->filter('tr:contains("HBCI-URL:")')->first();
            $infos['hbci_url'] = $hbciUrlRow->filter('td')->last()->text();

            $hbciPinTanTd = $table->filter('tr:contains("PIN/TAN URL:")')->first();
            $infos['hbci_url_pin_tan'] = $hbciPinTanTd->filter('td')->last()->text();
        });

        return (new FinTSDataSheet())
            ->setLocation($listItem->getLocation())
            ->setBankName($listItem->getBankName())
            ->setLocation($listItem->getLocation())
            ->setHbciUrl($infos['hbci_url'])
            ->setPinTanUrl($infos['hbci_url_pin_tan']);
    }
}
