@extends('layouts.app')
@section('content')
	<div class="container">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
		@endif
		@if (\Session::has('success'))
			<div class="alert alert-success">
				<p>{{\Session::get('success')}}</p>
			</div>
		@endif
		<h1>Bootstrap Modal</h1>
		<!-- Кнопка-триггер модального окна -->
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
			Open modal
		</button>

		<p>Список</p>
		<table>
			<thead>
				<tr>
					<th>Номер</th>
					<th>Начало тура, странцы назначения</th>
					<th>Действия</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($employees as $emp)
					<tr>
						<td>
							<a href="{{route('employee.show', $emp->id)}}">
								<div>
									№ {{$emp->id}}-{{Illuminate\Support\Str::limit(strip_tags($emp->created_at),4,'')}}
								</div>
								<div>

								</div>
							</a>
						</td>
						<td></td>
						<td>
							<form action="{{route('employee.destroy', $emp->id)}}" id="formDeleteRecord" method="post">
								@csrf
								@method('delete')
								<input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
								<button type="submit" class="btn btn-danger" data-id="{{$emp->id}}">Delete</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<!-- Модальное окно -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Заголовок модального окна</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
					</div>
					<form action="{{route('employee.store')}}" method="post" id="formCreate">
						@csrf
						<div class="modal-body">
							<input type="hidden" name="id">
							<div class="mb-3">
								<label for="fname" class="form-label">First Name</label>
								<input type="text" class="form-control" id="fname" name="fname" value="{{old('fname')}}">
								@error('fname')
									<div class="alert text-danger">{{$message}}</div>
								@enderror
							</div>
							<div class="mb-3">
								<label for="lname" class="form-label">Last Name</label>
								<input type="text" class="form-control" id="lname" name="lname" value="{{old('lname')}}">
								@error('lname')
									<div class="alert text-danger">{{$message}}</div>
								@enderror
							</div>
							<div class="mb-3">
								<label for="address">Address</label>
								<input type="text" class="form-control" id="address" name="address" value="{{old('address')}}">
								@error('address')
									<div class="alert text-danger">{{$message}}</div>
								@enderror
							</div>
							<div class="mb-3">
								<label for="mobile">Mobile</label>
								<input type="text" class="form-control" id="mobile" name="mobile" value="{{old('mobile')}}">
								@error('mobile')
									<div class="alert text-danger">{{$message}}</div>
								@enderror
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
							<button type="submit" class="btn btn-primary" id="saveClaim">Сохранить изменения</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('page-script')
	@include('scripts.ajax')
@endsection