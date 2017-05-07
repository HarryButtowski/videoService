<?php

namespace HarryButtowski\VideoService\Provider;

use Exception;

/**
 * Class RutubeProvider
 * @package HarryButtowski\VideoService\Provider
 */
class RutubeProvider extends Provider
{
    /**
     * @inheritdoc
     */
    public function getData(): array
    {
        $content             = $this->getContent();
        $response            = json_decode($content, true);
        $data['title']       = $response['title'] ?? '';
        $data['description'] = $response['description'] ?? '';
        $data['url_preview'] = $response['thumbnail_url'] ?? '';
        $data['iframe']      = $response['html'] ?? '';

        return $data;
    }

    /**
     * @return string
     * @throws Exception
     */
    private function getContent(): string
    {
        $url = $this->prepareUrl($this->getUrl());

        if ($response = @file_get_contents($url)) {
            return $response;
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
        $idVideo = $this->getIdVideoFromUrl($url);

        return sprintf('http://rutube.ru/api/video/%s', $idVideo);
    }

    /**
     * @param string $url
     *
     * @return string
     */
    private function getIdVideoFromUrl(string $url): string
    {
        preg_match('/video\/(.*)?\//', $url, $matches);

        return $matches[1] ?? null;
    }
}