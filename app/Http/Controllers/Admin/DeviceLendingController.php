<?php namespace App\Http\Controllers\Admin;

use \Doanthuan\Ladmin\Html\Toolbar;

class DeviceLendingController extends \Doanthuan\Ladmin\Controller\AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->model = new \App\DeviceLending();
    }

    public function anyIndex()
    {
        Toolbar::title('Lending Devices');

        if(\Request::has('did')) {
            $device = \App\Device::find(\Request::input('did'));
            Toolbar::title('Lending Devices'. ' ('.$device->Name.')');
        }

        return view('admin.device-lending.index');
    }
}
