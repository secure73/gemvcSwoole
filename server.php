<?php
declare(strict_types=1);
require('vendor/autoload.php');
require_once('vendor/gemvc/library/src/core/GemToken.php');
require_once('app/config.php');
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
//use Gemvc\Core\GemToken;
//use Gemvc\GemToken;

$http = new Server("0.0.0.0", 9501);

$http->on(
    "start",
    function (Server $http) {
        echo "Gemvc API is started on port 80.\n";
    }
);

$gemToken = new \Gemvc\Core\GemToken();
$http->on(
    "request",
    function (Request $request, Response $response) {
        $response->header("Content-Type", "application/json");
        $response->end(json_encode($request));
    }
);

$http->start();


