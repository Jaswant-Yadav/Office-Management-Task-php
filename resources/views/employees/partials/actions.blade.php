<a href="{{ route('employees.edit',$employee) }}" class="text-blue-600">Edit</a>
<form action="{{ route('employees.destroy',$employee) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this employee?')">
    @csrf @method('DELETE')
    <button class="text-red-600 ml-2">Delete</button>
</form>
