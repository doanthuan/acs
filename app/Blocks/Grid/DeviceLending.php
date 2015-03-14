<?php
namespace App\Blocks\Grid;

class DeviceLending extends \Doanthuan\Ladmin\Block\Grid{

    protected $keyCol = 'Id';

    protected function prepareCollection()
    {
        $query = \DB::table('DeviceLending')
            ->join('Devices', 'DeviceLending.DeviceId', '=', 'Devices.Id')
            ->join('Employees', 'DeviceLending.EmployeeId', '=', 'Employees.Id')
            ->select('DeviceLending.*', 'Devices.Name as DeviceName', 'Employees.DisplayName as EmployeeName');

        if(\Request::has('did')) {
            $query->where('DeviceId',\Request::input('did'));
        }


        $items = $this->getData($query);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'DeviceName',
            'header' => trans('Device'),
            'renderer' => new Renderer\DeviceLendingDeviceRenderer()
        ));

        $this->addColumn(array(
            'name' => 'EmployeeName',
            'header' => trans('Employee')
        ));

        $this->addColumn(array(
            'name' => 'StartDate',
            'header' => trans('StartDate')
        ));

        $this->addColumn(array(
            'name' => 'EndDate',
            'header' => trans('EndDate')
        ));
    }


}