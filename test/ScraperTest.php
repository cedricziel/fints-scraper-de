<?php

namespace CedricZiel\FinTSScraper\De;

use CedricZiel\FinTSScraper\De\Model\FinTSDataSheet;
use CedricZiel\FinTSScraper\De\Model\ListItem;
use PHPUnit\Framework\TestCase;

class ScraperTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $scraper = new Scraper();

        self::assertInstanceOf(ScraperInterface::class, $scraper);
    }

    public function testCanScrapeByBlz()
    {
        $scraper = new Scraper();

        $result = $scraper->scrapeByBlz('45850005');

        self::assertCount(1, $result);
    }

    public function testCanScrapeByNameAndLocation()
    {
        $scraper = new Scraper();

        $result = $scraper->scrapeByNameAndLocation('Sparkasse', 'Hagen');

        self::assertCount(2, $result);
    }

    public function testCanScrapeItem()
    {
        $item = new ListItem();
        $item
            ->setId(1440)
            ->setBankNumber('45050001')
            ->setBankName('Sparkasse HagenHerdecke')
            ->setLocation('Hagen');

        $result = (new Scraper())->scrapeItem($item);

        self::assertInstanceOf(FinTSDataSheet::class, $result);
    }
}
