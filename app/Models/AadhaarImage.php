<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AadhaarImage extends Model
{
    use HasFactory;
    protected $table = 'aadhaar_image';
    protected $guarded = [];
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (static::max('id') ?? 0) + 1;
            }
        });
    }
}
