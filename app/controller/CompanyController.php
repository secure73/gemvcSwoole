<?php
namespace App;

use Gemvc\Core\Controller as CoreController;
use Gemvc\Http\Request;
use Model\CompanyModel;
class CompanyController extends CoreController
{
    protected CompanyModel $_model;
    public function __construct(Request $request)
    {
        $this->_model = new CompanyModel();
        parent::__construct($request);
    }
    public function index()
    {
        return json_encode("hi from company Conrtoller");
    }
}
?>