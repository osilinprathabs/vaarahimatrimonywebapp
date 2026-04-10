<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanAssign extends Model
{
    use HasFactory;
    
    protected $table = 'plan_assign';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }
}
