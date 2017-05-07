<?php

namespace HarryButtowski\VideoService\Source;

/**
 * Class UrlSource
 */
class UrlSource implements Source
{
    /** @var string */
    private $_url;

    /**
     * UrlSource constructor.
     *
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->_url = $url;
    }

    /**
     * @inheritdoc
     */
    public function getUrl(): string
    {
        return $this->_url;
    }
}