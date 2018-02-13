<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productadmin extends Model
{
    protected $table = "product_admin";
    protected  $primaryKey = "id";

    protected $fillable = [
        'name',
        'phone',
        'mail',
        'p_name'
    ];
    protected $dates = [
        'created_at', 'updated_at'
    ];
}
