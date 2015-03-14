<?php
namespace App\Blocks\Grid\Renderer;

class DepartmentRenderer implements \Doanthuan\Ladmin\Block\Grid\RendererInterface{
    public function render($row)
    {
        $input = \Request::all();
        $input['did'] = $row->DepartmentId;
        $queryString = http_build_query($input);
        $url = \Request::url().'?'.$queryString;

        $html = '<a href="'.$url.'">'.$row->DepartmentName.'</a>';
        return $html;
    }
}