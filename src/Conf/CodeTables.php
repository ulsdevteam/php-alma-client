<?php

namespace Scriptotek\Alma\Conf;

use Scriptotek\Alma\Client;
use Scriptotek\Alma\Model\PaginatedListGenerator;
use Scriptotek\Alma\Model\SimplePaginatedList;
use Scriptotek\Alma\Model\ReadOnlyArrayAccess;
use Scriptotek\Alma\Conf\Library;

class CodeTables 
{
    use ReadOnlyArrayAccess;

    /* @var Client */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
    * Return an object containing the code table content.
    *
    * @return CodeTable object.
    */
    public function getCodeTable($codetable)
    {
        return json_decode($this->client->get($this->urlBase()."/$codetable"));
    }

    /**
    * Return a object containing a list of code tables.
    *
    * @return CodeTable ojbect list.
    */
    public function getCodeTables()
    {
        return json_decode($this->client->get($this->urlBase()));
    }

     /**
     * Generate the base URL for this resource.
     *
     * @return string
     */
    protected function urlBase()
    {
        return '/conf/code-tables';
    }
}

