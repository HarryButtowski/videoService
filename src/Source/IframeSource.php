<?php

namespace HarryButtowski\VideoService\Source;

use DOMDocument;

/**
 * Class IframeSource
 */
class IframeSource implements Source
{
    /** @var string */
    private $_iframe;

    /**
     * IframeSource constructor.
     *
     * @param string $iframe
     */
    public function __construct(string $iframe)
    {
        $this->_iframe = $iframe;
    }

    /**
     * @inheritdoc
     */
    public function getUrl(): string
    {
        $xml = new DOMDocument();

        return $xml->loadHTML($this->_iframe) ? $xml->getElementsByTagName('iframe')[0]->getAttribute('src') : '';
    }
}