<?php
namespace App\Blocks\Grid;

class VisitLog extends \Doanthuan\Ladmin\Block\Grid{

    protected $keyCol = 'Id';

    protected function prepareCollection()
    {
        $query = \DB::table('VisitLogs')
            ->join('Employees', 'VisitLogs.EmployeeId', '=', 'Employees.Id')
            ->join('Departments', 'Employees.DepartmentId', '=', 'Departments.Id')
            ->select('VisitLogs.*', 'Employees.DisplayName as EmployeeName', 'Employees.DepartmentId','Departments.Name as DepartmentName');

        if(\Request::has('eid')) {
            $query->where('EmployeeId',\Request::input('eid'));
        }

        if(\Request::has('did')) {
            $query->where('Employees.DepartmentId',\Request::input('did'));
        }

        $query->orderBy('Leave', 'DESC');

        $items = $this->getData($query);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'Arrival',
            'header' => trans('Arrival')
        ));

        $this->addColumn(array(
            'name' => 'Leave',
            'header' => trans('Leave')
        ));

        $this->addColumn(array(
            'name' => 'EmployeeName',
            'header' => trans('Visitor'),
            'renderer' => new Renderer\EmployeeRenderer()
        ));

        $this->addColumn(array(
            'name' => 'DepartmentName',
            'header' => trans('Company'),
            'renderer' => new Renderer\DepartmentRenderer()
        ));
//
//        $this->addColumn(array(
//            'name' => 'DeviceTypeName',
//            'header' => trans('DeviceTypes'),
//            'filter_type' => 'dropdown',
//            'filter_index' => 'DeviceTypeId',
//            'filter_data' => array(
//                'collection' => \App\DeviceType::all(),
//                'field_value' => 'Id',
//                'field_name' => 'Name',
//                'extraOptions' => array('' => trans('- Please Select -'))
//            )
//        ));



    }


}