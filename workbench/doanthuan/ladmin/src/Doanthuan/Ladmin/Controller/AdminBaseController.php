<?php
namespace Doanthuan\Ladmin\Controller;
use Input, View;

class AdminBaseController extends \Doanthuan\Ladmin\Controller\BaseController {

    public function __construct()
    {
        parent::__construct();

        $this->beforeFilter('admin.auth');
    }

    public function callAction($method, $parameters)
    {
        $task = Input::get('task');
        if(!empty($task)){
            $method = $task;
        }
        $response = parent::callAction($method, $parameters);

        //after controller action
        $toolbar = \Doanthuan\Ladmin\Html\Toolbar::toHtml();
        View::share('toolbar', $toolbar);

        return $response;
    }

}