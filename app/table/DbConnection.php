<?php
namespace Table;
use Gemvc\Database\PdoConnection;
use Gemvc\Database\PdoQuery;

class BbConnection
{
    public static function DefaultConnection():PdoQuery
    {
        $options__db = [
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ];
        $conn = new  PdoConnection("","root","password",$options__db);
        return new PdoQuery($conn);
    }
}