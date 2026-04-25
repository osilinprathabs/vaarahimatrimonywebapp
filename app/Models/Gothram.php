<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gothram extends Model
{
    use HasFactory;
    protected $table = 'gotharam';
    public $timestamps = false;
    protected $fillable = ['gotharam'];
}
