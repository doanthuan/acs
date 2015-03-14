<?php
namespace App\Blocks\Grid;

class DeviceType extends \Doanthuan\Ladmin\Block\Grid{

    protected $keyCol = 'Id';

    protected function prepareCollection()
    {
        $query = \DB::table('DeviceTypes');

        $items = $this->getData($query);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'Name',
            'header' => trans('Name'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'CreationDate',
            'header' => trans('CreationDate')
        ));

        $this->addColumn(array(
            'name' => 'IsActive',
            'header' => trans('IsActive'),
            'renderer' => new \App\Blocks\Grid\Renderer\IsActiveRenderer()
        ));

    }


}