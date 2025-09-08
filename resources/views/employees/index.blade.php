@extends('layouts.app')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-xl font-bold">Employees</h1>
    <a href="{{ route('employees.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Employee</a>
</div>

<div class="flex gap-4 mb-4">
    <select id="filterCompany" class="border p-2">
        <option value="">All Companies</option>
        @foreach($companies as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>

    <input type="text" id="filterPosition" placeholder="Filter by position" class="border p-2">
</div>

<table id="employeesTable" class="display w-full"></table>

<script>
$(function(){
    let table = $('#employeesTable').DataTable({
        ajax:{
            url:"{{ route('employees.data') }}",
            data:function(d){
                d.company=$('#filterCompany').val();
                d.position=$('#filterPosition').val();
            }
        },
        columns:[
            {data:'id',title:'ID'},
            {data:'name',title:'Name'},
            {data:'email',title:'Email'},
            {data:'position',title:'Position'},
            {data:'company',title:'Company'},
            {data:'manager',title:'Manager'},
            {data:'country',title:'Country'},
            {data:'state',title:'State'},
            {data:'city',title:'City'},
            {data:'actions',title:'Actions',orderable:false,searchable:false}
        ]
    });

    $('#filterCompany,#filterPosition').on('change keyup', ()=>table.ajax.reload());
});
</script>
@endsection
