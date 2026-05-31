<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';
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

    protected $fillable = [
        'name',
        'amount',
        'interest',
        'messages',
        'validity',
        'star_matching',
        'premium_list',
        'receive_interest',
        'express_interest',
        'shortlist_profile',
        'unlimited_profile_access',
        'priority_search',
        'image',
        'status'
    ];

    protected $casts = [
        'star_matching'            => 'boolean',
        'premium_list'             => 'boolean',
        'receive_interest'         => 'boolean',
        'express_interest'         => 'boolean',
        'shortlist_profile'        => 'boolean',
        'unlimited_profile_access' => 'boolean',
        'priority_search'          => 'boolean',
        'status'                   => 'boolean'
    ];
}
