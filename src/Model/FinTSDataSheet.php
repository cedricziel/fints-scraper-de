<?php

namespace CedricZiel\FinTSScraper\De\Model;

class FinTSDataSheet
{
    private $bankName;
    private $bankNumber;
    private $location;
    private $hbciUrl;
    private $pinTanUrl;

    /**
     * @return mixed
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * @param mixed $bankName
     * @return FinTSDataSheet
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBankNumber()
    {
        return $this->bankNumber;
    }

    /**
     * @param mixed $bankNumber
     * @return FinTSDataSheet
     */
    public function setBankNumber($bankNumber)
    {
        $this->bankNumber = $bankNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     * @return FinTSDataSheet
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHbciUrl()
    {
        return $this->hbciUrl;
    }

    /**
     * @param mixed $hbciUrl
     * @return FinTSDataSheet
     */
    public function setHbciUrl($hbciUrl)
    {
        $this->hbciUrl = $hbciUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPinTanUrl()
    {
        return $this->pinTanUrl;
    }

    /**
     * @param mixed $pinTanUrl
     * @return FinTSDataSheet
     */
    public function setPinTanUrl($pinTanUrl)
    {
        $this->pinTanUrl = $pinTanUrl;
        return $this;
    }
}
