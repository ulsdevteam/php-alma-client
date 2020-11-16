<?php

namespace Scriptotek\Alma\Conf;

use Scriptotek\Alma\Client;
use Scriptotek\Alma\Model\LazyResource;

/**
 * A single CodeTable resource.
 */
class CodeTable extends LazyResource
{
    /** @var string */
    public $code;

    /**
     * CodeTable constructor.
     *
     * @param Client $client
     * @param string $code
     */
    public function __construct(Client $client, $code)
    {
        parent::__construct($client);
        $this->code = $code;
    }

    /**
     * Check if we have the full representation of our data object.
     *
     * @param \stdClass $data
     *
     * @return bool
     */
    protected function isInitialized($data)
    {
        return isset($data->name);
    }

    /**
     * Generate the base URL for this resource.
     *
     * @return string
     */
    protected function urlBase()
    {
        return "/conf/code-tables/{$this->code}";
    }
}
