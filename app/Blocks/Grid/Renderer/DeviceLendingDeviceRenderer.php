<?php
namespace App\Blocks\Grid\Renderer;

class DeviceLendingDeviceRenderer implements \Doanthuan\Ladmin\Block\Grid\RendererInterface{
    public function render($row)
    {
//        $input = \Request::all();
//        $input['did'] = $row->DeviceId;
//        $queryString = http_build_query($input);

        $url = '/admin/device-lending?did='.$row->DeviceId;

        $html = '<a href="'.$url.'">'.$row->DeviceName.'</a>';
        return $html;
    }
}