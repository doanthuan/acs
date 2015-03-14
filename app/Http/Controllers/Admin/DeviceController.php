<?php namespace App\Http\Controllers\Admin;

class DeviceController extends \Doanthuan\Ladmin\Controller\AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->model = new \App\Device();
    }

}
