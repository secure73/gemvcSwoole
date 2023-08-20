<?php

declare(strict_types=1);
require('vendor/autoload.php');
require_once('app/config.php');

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
use Gemvc\Core\Security;
use Gemvc\Core\RequestDispatcher;
use Gemvc\GemToken;

$http = new Server("0.0.0.0", 9501);

$http->set([
    'http_compression' => true, // Enable HTTP compression for HTTP/2
]);

$http->on(
    "start",
    function (Server $http) {
        echo "Gemvc API is started on port 80.\n";
    }
);

$http->on(
    "request",
    function (Request $request, Response $response) {

        $token = null;
        if(isset($request->header['authorization']))
        {
            $token = $request->header['authorization'];
        }
        $remote_address = $request->server['remote_addr'];
        $remote_port = $request->server['remote_port'];
        $remote_address .= $remote_address . $remote_port;
        $payload = json_decode($request->post['payload']);
        $service_request = $request->post['service'];
        $serviceAndmethod = explode('/', $service_request);
        $service_name = ucfirst($serviceAndmethod[0]);
        $functionName = 'index';
        (isset($serviceAndmethod[1])) ? $functionName = $serviceAndmethod[1] : $functionName = 'index';

        $response->header("Content-Type", "application/json");
        $response->end(
            json_encode($request)
        );
    }
);

$http->start();
