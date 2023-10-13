<?php

declare(strict_types=1);
require('vendor/autoload.php');
require_once('app/config.php');

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;


$http = new Server("0.0.0.0", 9501);
$http->set([
    'http_compression' => true, // Enable HTTP compression for HTTP/2
]);
$http->on(
    "start",
    function (Server $http) {
        echo "Gemvc Aggregator API is started on port 80.\n";
    }
);

$http->on(
    "request",
    function (Request $request, Response $response) {
        $swooleRequest = new \Gemvc\Http\SwooleRequest($request);
        $request = $swooleRequest->request;
        $response->header("Content-Type", "application/json");
        $response->end(
            json_encode($request)
        );
    }
);

$http->start();
