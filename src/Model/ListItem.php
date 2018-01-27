<?php

namespace CedricZiel\FinTSScraper\De\Model;

class ListItem
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $bankNumber;

    /**
     * @var string
     */
    protected $bankName;

    /**
     * @var string
     */
    protected $location;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ListItem
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getBankNumber(): string
    {
        return $this->bankNumber;
    }

    /**
     * @param string $bankNumber
     * @return ListItem
     */
    public function setBankNumber(string $bankNumber)
    {
        $this->bankNumber = $bankNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getBankName(): string
    {
        return $this->bankName;
    }

    /**
     * @param string $bankName
     * @return ListItem
     */
    public function setBankName(string $bankName)
    {
        $this->bankName = $bankName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return ListItem
     */
    public function setLocation(string $location)
    {
        $this->location = $location;

        return $this;
    }
}
