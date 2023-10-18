<?php
namespace Table;
use Gemvc\Database\PdoConnection;

class ConnectionProvider
{
    public static function connect(string $connectionName = null):PdoConnection
    {
       $options__db = [
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ];
        if($connectionName)
        {
        return new  PdoConnection(self::dsn($connectionName),"root","",$options__db);

        }
        return new PdoConnection(self::dsn('default'),"root","",$options__db);
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