<?php

namespace HarryButtowski\VideoService\Provider;

use DOMDocument;
use Exception;

/**
 * Class YoutubeProvider
 * @package HarryButtowski\VideoService\Provider
 */
class YoutubeProvider extends Provider
{
    /**
     * @inheritdoc
     */
    public function getData(): array
    {
        /** @var DOMDocument $doc */
        $doc = $this->getDocument();

        $data['title'] = $this->encoding($doc->getElementsByTagName('title')[0]->nodeValue);

        foreach ($doc->getElementsByTagName('meta') as $node) {
            if ($node->getAttribute('name') == 'description') {
                $data['description'] = $this->encoding($node->getAttribute('content'));
            } else if ($node->getAttribute('property') == 'og:image') {
                $data['url_preview'] = $this->encoding($node->getAttribute('content'));
            }
        }

        foreach ($doc->getElementsByTagName('link') as $node) {
            if ($node->getAttribute('rel') == 'alternate' && $node->getAttribute('type') == 'application/json+oembed') {
                if ($embededContent = @file_get_contents($node->getAttribute('href'))) {
                    $embededArray   = json_decode($embededContent, true);
                    $data['iframe'] = $embededArray['html'] ?? '';
                }
            }
        }

        return $data ?? [];
    }

    /**
     * @return DOMDocument
     * @throws Exception
     */
    private function getDocument(): DOMDocument
    {
        $doc = new DOMDocument();
        $url = $this->prepareUrl($this->getUrl());

        if (@$doc->loadHTMLFile($url)) {
            return $doc;
        } else {
            throw new Exception('Not found', 404);
        }
    }

    /**
     * @param string $url
     *
     * @return string
     */
    private function prepareUrl(string $url): string
    {
        if (strpos($url, 'embed')) {
            preg_match('/embed\/(.*)?\?/', $url, $matches);
            $url = isset($matches[1]) ? sprintf('https://www.youtube.com/watch?v=%s', $matches[1]) : $url;
        }

        return $url;
    }

    /**
     * @param string $text
     *
     * @return string
     */
    private function encoding(string $text): string
    {
        return mb_convert_encoding($text, "WINDOWS-1252");
    }
}