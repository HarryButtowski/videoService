<?php

namespace HarryButtowski\VideoService\Tests;

use HarryButtowski\VideoService\Source\IframeSource;
use PHPUnit\Framework\TestCase;

class IframeSourceTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testGetUrl($url, $iframe)
    {
        $source = new IframeSource($iframe);

        $this->assertEquals($url, $source->getUrl());
    }

    public function additionProvider()
    {
        return [
            ['https://www.youtube.com/embed/tR5wvHJ_0eQ?ecver=2', '<div style="position:relative;height:0;padding-bottom:75.0%"><iframe src="https://www.youtube.com/embed/tR5wvHJ_0eQ?ecver=2" width="480" height="360" frameborder="0" style="position:absolute;width:100%;height:100%;left:0" allowfullscreen></iframe></div>'],
            ['//rutube.ru/play/embed/7027144', '<iframe width="720" height="405" src="//rutube.ru/play/embed/7027144" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe><p><a href="https://rutube.ru/video/57b1d4b63e617a4db441af518bfa45be/">Потап и Настя – Чумачечая весна (#LIVE Авторадио)</a> от <a href="https://rutube.ru/metainfo/tv/3183/">Авторадио</a> на <a href="https://rutube.ru">Rutube</a>.</p>'],
        ];
    }
}