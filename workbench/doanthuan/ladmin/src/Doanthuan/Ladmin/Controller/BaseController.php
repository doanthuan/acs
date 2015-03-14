<?php
namespace Doanthuan\Ladmin\Controller;
use Controller, View, Session;

class BaseController extends \Illuminate\Routing\Controller {

    protected $ignoreCsrf = false;

    public function __construct()
    {
        if(!$this->ignoreCsrf){
            $this->beforeFilter('csrf', array('on' => 'post'));
        }

        View::composer(array( '*' ), function ($view){

            $view->with('success', Session::get('success' , '' ) );

        });
    }
}