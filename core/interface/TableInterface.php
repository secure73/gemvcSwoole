<?php
namespace Core\interface;
interface TableInterface
{
    /**
     * @return string
     * shall return table name in database for ex: users , companies, etc...
     */
    public function getTable():string;
}