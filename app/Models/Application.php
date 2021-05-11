<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


class Application extends Model
{
    use HasRoles;
    
    protected $fillable = [
        'name', 'identity', 'email', 'nationality_id',
        'phone', 'iban', 'address', 'married', 'has_childrens',
        'childrens', 'cv', 'infection', 'criminal', 'is_active'
    ];

    public function getIsActiveTxtAttribute()
    {
        if ($this->is_active == 0) {
            $txt = '<span class="badge badge-pill badge-info"> في الإنتظار </span>';
        } else if ($this->is_active == 1) {
            $txt = '<span class="badge badge-pill badge-success">  تم الإضافة </span>';
        } else {
            $txt = '<span class="badge badge-pill badge-danger"> مرفوض </span>';
        }
        return $txt;
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
}
