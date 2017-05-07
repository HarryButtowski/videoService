<?php

namespace HarryButtowski\VideoService\Provider;

/**
 * Class Provider
 * @package HarryButtowski\VideoService\Provider
 */
abstract class Provider
{
    /** @var  string */
    private $_url;

    function __construct(string $url)
    {
        $this->_url = $url;
    }

    /**
     * @return array
     */
    abstract public function getData(): array;

    /**
     * @return string
     */
    protected function getUrl(): string
    {
        return $this->_url;
    }
}