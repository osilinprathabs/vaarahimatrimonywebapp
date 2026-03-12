<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JathagamImage extends Model
{
    use HasFactory;
    protected $table = 'jathagam_images';
    protected $guarded = [];
    public $timestamps = false;
}
