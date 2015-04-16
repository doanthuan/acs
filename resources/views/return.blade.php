@extends('layouts.public')

@section('content')
{!! Form::open(array('url' => 'lending/return', 'class' => 'form-return'))!!}

@if( \Session::has('success') )
    <div class="alert alert-success well-sm">
        {{ \Session::get('success') }}
    </div>
@endif

<fieldset>
    <legend>trans('messages.Return Device')</legend>

    <div class="form-group">
        {!! Form::label('RetDeviceId', trans('messages.Device Id')) !!}
        {!! Form::text('RetDeviceId', null, array('class' => 'form-control', 'required')) !!}
        <div class="error">{{$errors->first('RetDeviceId')}}</div>
    </div>

    <button type="submit" class="btn btn-primary">trans('messages.Submit')</button>
    <a class="btn btn-default pull-right" href="/">trans('messages.Back')</a>

</fieldset>

{!! Form::close()!!}
@stop