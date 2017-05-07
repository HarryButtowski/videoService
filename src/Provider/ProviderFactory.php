<?php

namespace HarryButtowski\VideoService\Provider;

use Exception;

/**
 * Class ProviderFactory
 * @package HarryButtowski\VideoService\Provider
 */
class ProviderFactory
{
    /**
     * @param string $url
     *
     * @return Provider
     * @throws Exception
     */
    public static function create(string $url): Provider
    {
        $provider = null;

        if ($urlComponents = parse_url($url)) {
            switch ($urlComponents['host']) {
                case 'rutube.ru':
                    $provider = new RutubeProvider($url);
                    break;
                case 'youtu.be':
                case 'www.youtube.com':
                    $provider = new YoutubeProvider($url);
                    break;
                default:
                    throw new Exception('Video provider is not defined', 404);

                    break;
            }
        }

        return $provider;
    }
}