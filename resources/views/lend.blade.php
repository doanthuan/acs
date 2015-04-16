@extends('layouts.public')

@section('content')
{!! Form::open(array('url' => 'lending/lending', 'class' => 'form-lending'))!!}

@if( \Session::has('success') )
    <div class="alert alert-success well-sm">
        {{ \Session::get('success') }}
    </div>
@endif

<fieldset>
    <legend>trans('messages.Lend Device')</legend>

    <div class="form-group">
        {!! Form::label('DeviceId', trans('messages.Device Id')) !!}
        {!! Form::text('DeviceId', null, array('class' => 'form-control', 'required')) !!}
        <div class="error">{{$errors->first('DeviceId')}}</div>
    </div>

    <div class="form-group">
        {!! Form::label('EmployeeId', trans('messages.Employee Id')) !!}
        {!! Form::text('EmployeeId', null, array('class' => 'form-control', 'required')) !!}
        <div class="error">{{$errors->first('EmployeeId')}}</div>
    </div>

    <button type="submit" class="btn btn-primary">trans('messages.Submit')</button>
    <a class="btn btn-default pull-right" href="/">trans('messages.Back')</a>

</fieldset>

{!! Form::close()!!}

@stop