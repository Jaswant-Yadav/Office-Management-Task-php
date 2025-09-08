@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Edit Employee</h1>
@include('employees.form', ['route' => route('employees.update',$employee), 'method' => 'PUT'])
@endsection
