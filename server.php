<?php

declare(strict_types=1);
require('vendor/autoload.php');
require_once('app/config.php');

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
use Gemvc\Core\Security;
use Gemvc\Core\RequestDispatcher;
use Gemvc\Core\GemToken;
use Gemvc\Helper\JsonHelper;
use Gemvc\Core\HttpResponse;

$http = new Server("0.0.0.0", 9501);

$http->set([
    'http_compression' => true, // Enable HTTP compression for HTTP/2
]);
$gemToken = new GemToken();
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
        $payload = null;
        $service_request = null;
        $serviceAndmethod = null;
        $service_name = null;
        $functionName = null;
        $find = null;
        $orderby = null;
        $page = null;
        $count = null;
        if(isset($request->header['authorization']))
        {
            $token = $request->header['authorization'];
        }
        $remote_address = $request->server['remote_addr'];
        $remote_port = $request->server['remote_port'];
        $remote_address .= $remote_address . $remote_port;
        if(isset($request->post['payload']))
        {
            $payload = json_decode($request->post['payload']);
        }
        if(isset($request->post['service']))
        {
            $service_request = $request->post['service'];
            $serviceAndmethod = explode('/', $service_request);
            $service_name = ucfirst($serviceAndmethod[0]);
            $functionName = 'index';
            (isset($serviceAndmethod[1])) ? $functionName = $serviceAndmethod[1] : $functionName = 'index';
        }
        if(isset($request->post['find']))
        {
            $find = trim($request->post['find']);
            $find = JsonHelper::validateJsonStringReturnObject($find);
        }
        if(isset($request->post['orderby']))
        {
            $orderby = trim($request->post['orderby']);
            $orderby = JsonHelper::validateJsonStringReturnObject($orderby);
        }
        if(isset($request->post['page']))
        {
            $page = trim($request->post['page']);
            $page = JsonHelper::validateJsonStringReturnObject($page);
        }
        if(isset($request->post['count']))
        {
            $count = trim($request->post['count']);
            $count =  (is_numeric($count)) ? intval($count) : null;
        }

        $response->header("Content-Type", "application/json");
        $response->end(
            json_encode($request)
        );
    }
);

$http->start();
