<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StakeHolder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type_id',
        'name',
        'address',
        'phone',
    ];

    public function type(){
        return $this->belongsTo(Type::class);
    }
}
