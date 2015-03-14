<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ACS</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

<div class="container">

	@if( \Session::has('success') )
		<div class="alert alert-success well-sm">
			{{ \Session::get('success') }}
		</div>
	@endif

	<div class="row">
		<div class="col-sm-12">
			<div class="col-xs-12 col-sm-6">
				{!! Form::open(array('url' => 'lending/lending', 'class' => 'form-lending'))!!}

				<fieldset>
					<legend>Lend a device</legend>

					<div class="form-group">
						{!! Form::label('DeviceId', 'Device Id') !!}
						{!! Form::text('DeviceId', null, array('class' => 'form-control', 'required')) !!}
						<div class="error">{{$errors->first('DeviceId')}}</div>
					</div>

					<div class="form-group">
						{!! Form::label('EmployeeId', 'Employee Id') !!}
						{!! Form::text('EmployeeId', null, array('class' => 'form-control', 'required')) !!}
						<div class="error">{{$errors->first('EmployeeId')}}</div>
					</div>

					<button type="submit" class="btn btn-primary">Submit</button>

				</fieldset>

				{!! Form::close()!!}
			</div>
			<div class="col-xs-12 col-sm-6">
				{!! Form::open(array('url' => 'lending/return', 'class' => 'form-return'))!!}

				<fieldset>
					<legend>Return a device</legend>

					<div class="form-group">
						{!! Form::label('RetDeviceId', 'Device Id') !!}
						{!! Form::text('RetDeviceId', null, array('class' => 'form-control', 'required')) !!}
						<div class="error">{{$errors->first('RetDeviceId')}}</div>
					</div>

					<button type="submit" class="btn btn-primary">Submit</button>

				</fieldset>

				{!! Form::close()!!}
			</div>
		</div>
	</div>



</div>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>