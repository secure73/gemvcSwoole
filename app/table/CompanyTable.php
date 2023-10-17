<?php
namespace App\Table;

use Gemvc\Database\PdoConnection;
use Gemvc\Database\QueryBuilder;

class CompanyTable 
{
    public PdoConnection $pdoQuery;
    public QueryBuilder $queryBuilder;
    public function __construct()
    {
    }

    public function insert()
    {
       $query = QueryBuilder::insert('companies')->columns('name','companyfiled')->values('haa','bb');
    }


}