<?php
namespace App;

use Gemvc\Core\Controller as CoreController;
use Gemvc\Http\Request;

class CompanyController extends CoreController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    public function index()
    {
        return json_encode("hi from company Conrtoller");
    }
}
?>