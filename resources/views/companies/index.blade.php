@extends('layouts.app')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-xl font-bold">Companies</h1>
    <a href="{{ route('companies.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Company</a>
</div>

<table class="min-w-full bg-white border">
    <thead>
        <tr>
            <th class="p-2 border">Name</th>
            <th class="p-2 border">Location</th>
            <th class="p-2 border">Website</th>
            <th class="p-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
        <tr>
            <td class="border p-2">{{ $company->name }}</td>
            <td class="border p-2">{{ $company->location }}</td>
            <td class="border p-2">{{ $company->website }}</td>
            <td class="border p-2 flex gap-2">
                <a href="{{ route('companies.edit',$company) }}" class="text-blue-600">Edit</a>
                <form action="{{ route('companies.destroy',$company) }}" method="POST" onsubmit="return confirm('Delete this company?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $companies->links() }}
</div>
@endsection
