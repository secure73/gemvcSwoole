<?php
namespace App\Table;

use Core\interface\TableInterface;
use Gemvc\Database\PdoQuery;
use Gemvc\Trait\Controller\RemoveTrait;
use Gemvc\Trait\Table\InsertTrait;
use Table\ConnectionProvider;

class CompanyTable extends PdoQuery implements TableInterface{
    use InsertTrait;
    use RemoveTrait;
    public $id;
    public $name;

    public function __construct()
    {
        parent::__construct(ConnectionProvider::connect());
    }

    public function getTable():string
    {
        return 'companies';
    }


}