@extends('admin.layouts.admin')

@section('content')

    <?php echo (new \App\Blocks\Grid\DeviceType())->toHtml() ?>

@stop