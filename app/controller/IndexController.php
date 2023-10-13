<?php

use Gemvc\Core\Controller;
class IndexController extends Controller
{
    public function index()
    {
        return json_encode("hi");
    }
}
?>