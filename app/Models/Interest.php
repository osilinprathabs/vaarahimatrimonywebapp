<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $table = 'interests';

    protected $fillable = [
        'from_member_id',
        'to_member_id',
        'plan_id',
        'plan_name',
        'consumed_interests',
        'status',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'from_member_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_member_id', 'id');
    }
}
