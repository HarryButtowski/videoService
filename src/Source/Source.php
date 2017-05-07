<?php

namespace HarryButtowski\VideoService\Source;

/**
 * Interface Source
 * @package HarryButtowski\VideoService\Source
 */
interface Source
{
    /**
     * @return string
     */
    public function getUrl(): string;
}