<?php

namespace HarryButtowski\VideoService;

use Exception;
use HarryButtowski\VideoService\Provider\Provider;
use HarryButtowski\VideoService\Provider\ProviderFactory;
use HarryButtowski\VideoService\Source\Source;

/**
 * Class VideoService
 */
class VideoService
{
    /** @var  string */
    private $_url;

    /** @var array */
    private $_attributes;

    /**
     * VideoService constructor.
     *
     * @param Source $source
     * @param array  $attributes
     */
    public function __construct(Source $source, array $attributes)
    {
        $this->_url        = $source->getUrl();
        $this->_attributes = $attributes;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getDataVideo(): array
    {
        $provider = $this->getProvider();
        $data     = $provider->getData();

        return array_intersect_key($data, array_flip($this->_attributes));
    }

    /**
     * @return Provider
     */
    private function getProvider(): Provider
    {
        return ProviderFactory::create($this->_url);
    }
}