<?php

namespace CedricZiel\FinTSScraper\De;

interface ScraperInterface
{
    public function scrapeByBlz(string $blz): array;
    public function scrapeByNameAndLocation(string $name, $location = null): array;
}
