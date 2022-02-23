<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type_id',
        'user_id',
        'stakeholder_id',
        'location',
        'title',
        'description',
        'image_path',
        'status',
        'action'
    ];

    protected $appends = [
        'image_url',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function stakeholder(){
        return $this->belongsTo(StakeHolder::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path == null ? Storage::url($this->image_path) : null;
    }
}
