<?php

namespace HarryButtowski\VideoService\Tests;

use HarryButtowski\VideoService\Source\UrlSource;
use PHPUnit\Framework\TestCase;

class UrlSourceTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testGetUrl($url)
    {
        $urlSource = new UrlSource($url);

        $this->assertEquals($url, $urlSource->getUrl());
    }

    public function additionProvider()
    {
        return [
            ['https://www.youtube.com/watch?v=tR5wvHJ_0eQ'],
            ['https://rutube.ru/video/442d71010f461943c97c851a20aad9b0/?pl_id=3720&pl_type=tag'],
        ];
    }
}