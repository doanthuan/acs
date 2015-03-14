<?php
namespace App\Blocks\Grid\Renderer;

class EmployeeRenderer implements \Doanthuan\Ladmin\Block\Grid\RendererInterface{
    public function render($row)
    {
        $input = \Request::all();
        $input['eid'] = $row->EmployeeId;
        $queryString = http_build_query($input);
        $url = \Request::url().'?'.$queryString;

        $html = '<a href="'.$url.'">'.$row->EmployeeName.'</a>';
        return $html;
    }
}