@extends('admin.layouts.admin')

@section('content')

    <?php echo (new \App\Blocks\Grid\Device())->toHtml() ?>

@stop