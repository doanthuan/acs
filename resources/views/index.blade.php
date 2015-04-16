@extends('layouts.public')

@section('content')
	<div class="text-center">
		<a href="/lend" class="btn btn-primary btn-lg">{{trans('messages.Lend Device')}}</a>
		<a href="/return" class="btn btn-default btn-lg">{{trans('messages.Return Device')}}</a>
	</div>
@stop