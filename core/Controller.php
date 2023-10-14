<?php

namespace Gemvc\Core;

use Gemvc\Helper\TypeHelper;
use Gemvc\Http\Request;
use Gemvc\Http\JsonResponse;

class Controller
{
    public JsonResponse      $response;
    public Request           $request;
    public ?object           $payload;
    public ?int              $user_id;
    public float             $cost;
    protected ?object        $model; 
    protected string         $requestTime;
    private   float          $start_execution_time;
    

    public function __construct(Request $request)
    {
        $this->response = new JsonResponse();
        $this->request = $request;
    }

    public function runMerhod()
    {
        if (method_exists($this, $this->request->requestMethod)) {
            call_user_func([$this, $this->request->requestMethod]);
        } else {
           $this->endExecution();
           $this->response->notFound('The requested method not found');
        }
    }

    /**
     * @param array<string> $arrayNeededPayloadKeys
     */
    protected function neededPayloadKeys(array $arrayNeededPayloadKeys): false|object
    {
        if(isset($this->payload))
        {
            $notfound = array();
            foreach($arrayNeededPayloadKeys as $item)
            {
                if(!isset($this->payload->$item))
                {
                    $notfound[] = $item;
                }
            }
            if(count($notfound)>0)
            {
                $message = "";
                foreach($notfound as $item)
                {
                    $message .= $item;
                }
                $this->response->badRequest('in Payload not found:'.$message);
            }
            else
            {
                return $this->payload;
            }

        }
        return false;

    }

    public function endExecution(): void
    {
        $now = microtime(true);
        $this->cost = ($now - $this->start_execution_time) * 1000;
        $this->response->cost = $this->cost;
    }
}
