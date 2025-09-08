<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model {
    protected $fillable = [
        'first_name','last_name','email','position',
        'company_id','manager_id','country','state','city'
    ];

    public function company(): BelongsTo {
        return $this->belongsTo(Company::class);
    }

    public function manager(): BelongsTo {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function subordinates(): HasMany {
        return $this->hasMany(Employee::class, 'manager_id');
    }

    public function getFullNameAttribute() {
        return trim($this->first_name . ' ' . $this->last_name);
    }
}
