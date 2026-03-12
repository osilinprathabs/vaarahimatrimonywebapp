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
}
