<?php
namespace App\Blocks\Grid\Renderer;

class DeviceNameRenderer implements \Doanthuan\Ladmin\Block\Grid\RendererInterface{
    public function render($row)
    {
        $url = '/admin/device-lending?did='.$row->Id;

        $html = '<a href="'.$url.'">'.$row->Name.'</a>';
        return $html;
    }
}