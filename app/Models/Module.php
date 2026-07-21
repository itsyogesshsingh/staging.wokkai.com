<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'saas_modules';
    protected $primaryKey = 'module_id';
    protected $fillable = [];
    protected $casts = [];

    public function setModuleNameAttribute($value)
    {
        $this->attributes['module_name'] = ucwords($value);
    }
}
