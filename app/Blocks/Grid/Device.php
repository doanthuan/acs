<?php
namespace App\Blocks\Grid;

class Device extends \Doanthuan\Ladmin\Block\Grid{

    protected $keyCol = 'Id';

    protected function prepareCollection()
    {
        $query = \DB::table('Devices')
            ->join('DeviceTypes', 'Devices.DeviceTypeId', '=', 'DeviceTypes.Id')
            ->select('Devices.*', 'DeviceTypes.Name as DeviceTypeName');

        $items = $this->getData($query);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'Name',
            'header' => trans('Name'),
            'renderer' => new Renderer\DeviceNameRenderer()
        ));

        $this->addColumn(array(
            'name' => 'BarCode',
            'header' => trans('BarCode'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'DeviceTypeName',
            'header' => trans('DeviceTypes'),
            'filter_type' => 'dropdown',
            'filter_index' => 'DeviceTypeId',
            'filter_data' => array(
                'collection' => \App\DeviceType::all(),
                'field_value' => 'Id',
                'field_name' => 'Name',
                'extraOptions' => array('' => trans('- Please Select -'))
            )
        ));



    }


}