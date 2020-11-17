@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('All Users') }}</div>

                <div class="card-body">
                  <table class="table">
					  <thead>
					    <tr>
					      <th scope="col">name</th>
					      <th scope="col">email</th>
					      <th scope="col">roles</th>
					      <th scope="col" colspan=2>actions</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($users as $user)
					    <tr>
					      <td>{{$user->name}}</td>
					      <td>{{$user->email}}</td>
					      <td>{{implode(',', $user->roles()->get()->pluck('name')->toArray())}}</td>
					      <td>
					      	<a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-info">Edit</a>
					      </td>
					      <td>
					      	<form action="{{route('admin.users.destroy', $user->id)}}" method="POST">
					      		@csrf
					      		@method('DELETE')
					      		<button type="submit" class="btn btn-warning">Delete</button>
					      	</form>
					      	
					      </td>
					    </tr>
					   @endforeach
					  </tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
