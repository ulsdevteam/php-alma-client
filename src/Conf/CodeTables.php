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
    
    protected $codeTables;

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
        $codeTable = json_decode($this->client->get($this->urlBase()."/$codetable"));
        return($codeTable);
        #return json_decode($this->client->get($this->urlBase()."/$codetable"));
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
        $found = array();
        $my_codetable = $this->getCodeTable($codetable);
        var_dump($my_codetable);
        $rows = $my_codetable->row;

        print "Name: $name - Desc: $desc\n";

        foreach ($rows as $row) {
            #var_dump($row);
            if ($row->code == $code) {
                array_push($found,$row);
                $count++;
            }
        }
        print "Total Found Rows in $codetable: $count\n";

        print "Found:\n";
        var_dump($found);

        return($found);
    }


    /**
    * Return a object containing a list of code tables.
    *
    * @return CodeTable ojbect list.
    */
    public function getCodeTables()
    {
        $this->codeTables = json_decode($this->client->get($this->urlBase()));
        return($this->codeTables);
        #return json_decode($this->client->get($this->urlBase()));
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

