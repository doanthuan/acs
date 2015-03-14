@extends('admin.layouts.admin')

@section('content')
    {!! Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/device-type/edit'))!!}

    <div class="form-group">
        {!! Form::label('Name', 'Name', array('class' => 'col-sm-2 control-label')) !!}
        <div class="col-sm-6">
            {!! Form::text('Name', null, array('class' => 'form-control', 'required')) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('IsActive') !!}
                    {!! Form::label('IsActive', 'Is Active') !!}
                </label>
            </div>
        </div>
    </div>

    {!!Form::hidden('Id')!!}


    {!! Form::close()!!}

@stop

@section('footer')
    @parent
    <script src="{!!url('js/jquery.validate.min.js')!!}"></script>
@stop