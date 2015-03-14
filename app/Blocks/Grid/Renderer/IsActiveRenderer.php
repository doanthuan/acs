<?php
namespace App\Blocks\Grid\Renderer;

class IsActiveRenderer implements \Doanthuan\Ladmin\Block\Grid\RendererInterface{
    public function render($row)
    {
        return ($row->IsActive)?'True':'False';
    }
}