@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Edit Company</h1>

<form method="POST" action="{{ route('companies.update',$company) }}" class="bg-white p-4 shadow rounded">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="block">Name</label>
        <input type="text" name="name" value="{{ $company->name }}" class="border p-2 w-full" required>
    </div>
    <div class="mb-3">
        <label class="block">Location</label>
        <input type="text" name="location" value="{{ $company->location }}" class="border p-2 w-full">
    </div>
    <div class="mb-3">
        <label class="block">Website</label>
        <input type="text" name="website" value="{{ $company->website }}" class="border p-2 w-full">
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
