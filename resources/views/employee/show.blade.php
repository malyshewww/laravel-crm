@extends('layouts.app')
@section('content')
	<div class="container">
		<h1>Show</h1>
		<div>
			{{$emp->id}}. {{$emp->mobile}}
		</div>
	</div>
@endsection