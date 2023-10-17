<?php
namespace Table;
use Gemvc\Database\PdoConnection;
use Gemvc\Database\PdoQuery;

class DbQuery
{
    public static function connect(string $connectionName):PdoQuery
    {
       $options__db = [
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ];
        return new PdoQuery(new PdoConnection(self::dsn($connectionName),"root","",$options__db));
    }

    private static function dsn(string $connecionName):string
    {
        $dsn = DB_CONNECTIONS[$connecionName];
        if($dsn['type'] == 'mysql')
        {
            return self::createMysqlDsn($dsn);
        }
        return "";
    }

    private static function createMysqlDsn(array $arrayConnection)
    {
        $string = $arrayConnection['type'].'host='.$arrayConnection['host'].';dbname='.$arrayConnection['database_name'].';charset=UTF8';
        if($arrayConnection['port'] !== "")
        {
            $string .= ';'.$arrayConnection['port'];
        }
        return $string;
    }
}