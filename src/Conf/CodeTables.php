<?php

namespace Scriptotek\Alma\Conf;

use Scriptotek\Alma\Client;
use Scriptotek\Alma\Model\ReadOnlyArrayAccess;

/**
 * A non-iterable collection of CodeTable resources
 */
class CodeTables implements \ArrayAccess
{
    use ReadOnlyArrayAccess;

    protected $client;

    /**
     * CodeTables constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get a CodeTable by identifier
     *
     * @param $code The identifier of a CodeTable
     *
     * @return CodeTable
     */
    public function get($code)
    {
        return CodeTable::make($this->client, $code);
    }
}
