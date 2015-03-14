<?php namespace App\Http\Controllers\Admin;

use \Doanthuan\Ladmin\Html\Toolbar;

class VisitLogController extends \Doanthuan\Ladmin\Controller\AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->model = new \App\VisitLog();
    }

    public function anyIndex()
    {
        Toolbar::title('Visit Logs');

        if(\Request::has('eid')) {
            $employee = \App\Employee::find(\Request::input('eid'));
            Toolbar::title('Visit Logs'. ' ( Employee: '.$employee->DisplayName.')');
        }

        if(\Request::has('did')) {
            $name = \DB::table('Departments')->find(\Request::input('did'))->Name;
            Toolbar::title('Visit Logs'. ' ( Department: '.$name.')');
        }

        return view('admin.visit-log.index');
    }
}
