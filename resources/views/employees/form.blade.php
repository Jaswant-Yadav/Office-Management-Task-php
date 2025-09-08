<form method="POST" action="{{ $route }}" class="bg-white p-4 shadow rounded">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block">First Name</label>
            <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name ?? '') }}" class="border p-2 w-full" required>
        </div>
        <div>
            <label class="block">Last Name</label>
            <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name ?? '') }}" class="border p-2 w-full">
        </div>
        <div>
            <label class="block">Email</label>
            <input type="email" name="email" value="{{ old('email', $employee->email ?? '') }}" class="border p-2 w-full" required>
        </div>
        <div>
            <label class="block">Position</label>
            <input type="text" name="position" value="{{ old('position', $employee->position ?? '') }}" class="border p-2 w-full">
        </div>
        <div>
            <label class="block">Company</label>
            <select name="company_id" class="border p-2 w-full">
                <option value="">-- Select Company --</option>
                @foreach($companies as $c)
                    <option value="{{ $c->id }}" {{ (old('company_id',$employee->company_id ?? '')==$c->id)?'selected':'' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block">Manager</label>
            <select name="manager_id" class="border p-2 w-full">
                <option value="">-- None --</option>
                @foreach($managers as $m)
                    <option value="{{ $m->id }}" {{ (old('manager_id',$employee->manager_id ?? '')==$m->id)?'selected':'' }}>
                        {{ $m->full_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block">Country</label>
            <select name="country" id="country" class="border p-2 w-full"></select>
        </div>
        <div>
            <label class="block">State</label>
            <select name="state" id="state" class="border p-2 w-full"></select>
        </div>
        <div>
            <label class="block">City</label>
            <select name="city" id="city" class="border p-2 w-full"></select>
        </div>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Save</button>
</form>

<script>
$(function(){
    // 1. Load Countries
    $.get("https://countriesnow.space/api/v0.1/countries", function(response){
        $("#country").html('<option value="">--Select--</option>');
        response.data.forEach(c=>{
            $("#country").append(`<option value="${c.country}">${c.country}</option>`);
        });

        // restore old value if editing
        $("#country").val("{{ old('country',$employee->country ?? '') }}");
        if($("#country").val()) loadStates($("#country").val());
    });

    // 2. Load states when country changes
    $("#country").on('change', function(){
        loadStates($(this).val());
    });

    function loadStates(country){
        $.ajax({
            url:"https://countriesnow.space/api/v0.1/countries/states",
            method:"POST",
            contentType:"application/json",
            data:JSON.stringify({ country: country }),
            success:function(res){
                $("#state").html('<option value="">--Select--</option>');
                if(res.data.states){
                    res.data.states.forEach(s=>{
                        $("#state").append(`<option value="${s.name}">${s.name}</option>`);
                    });
                }
                $("#state").val("{{ old('state',$employee->state ?? '') }}");
                if($("#state").val()) loadCities(country,$("#state").val());
            }
        });
    }

    // 3. Load cities when state changes
    $("#state").on('change', function(){
        loadCities($("#country").val(), $(this).val());
    });

    function loadCities(country,state){
        $.ajax({
            url:"https://countriesnow.space/api/v0.1/countries/state/cities",
            method:"POST",
            contentType:"application/json",
            data:JSON.stringify({ country: country, state: state }),
            success:function(res){
                $("#city").html('<option value="">--Select--</option>');
                if(res.data){
                    res.data.forEach(c=>{
                        $("#city").append(`<option value="${c}">${c}</option>`);
                    });
                }
                $("#city").val("{{ old('city',$employee->city ?? '') }}");
            }
        });
    }
});
</script>
