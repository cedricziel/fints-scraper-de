<?php

namespace CedricZiel\FinTSScraper;

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

class Scraper implements ScraperInterface
{
    const SEARCH_BASE_URL = 'https://www.hbci-zka.de/institute/institut_select.php';

    /**
     * @var Client
     */
    protected $client;

    public function __construct()
    {
        $this->client = new GuzzleClient();
    }

    public function scrapeByBlz(string $blz): array
    {
        $crawler = $client->request('GET', 'https://github.com/');
        $crawler = $client->click($crawler->selectLink('Sign in')->link());
        $form = $crawler->selectButton('Sign in')->form();
        $crawler = $client->submit($form, array('login' => 'fabpot', 'password' => 'xxxxxx'));
        $crawler->filter('.flash-error')->each(function ($node) {
            print $node->text()."\n";
        });

    }

    public function scrapeByNameAndLocation(string $name, $location = null): array
    {
        // TODO: Implement scrapeByNameAndLocation() method.
    }
}
