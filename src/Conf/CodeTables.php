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
    * Return a single row referring to the code table.
    *
    * @param $codetable - Code Table to pull from.
    * @param $code - The code in the Table we want to pull.
    *
    * @return object - the row in the code table.
    */
    public function getCodeTableRowByCode($codetable,$code)
    {
        echo "CodeTable: $codetable\n";
        echo "Code:      $code\n";
        $count = 0;
        foreach ($this->getCodeTable($codetable) as $row) {
            $count++;
        }
        print "Total Rows in $codetable: $count\n";
        return;
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

