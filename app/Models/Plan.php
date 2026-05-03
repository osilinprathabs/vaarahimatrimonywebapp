<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

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
        'star_matching' => 'boolean',
        'premium_list' => 'boolean',
        'receive_interest' => 'boolean',
        'express_interest' => 'boolean',
        'shortlist_profile' => 'boolean',
        'unlimited_profile_access' => 'boolean',
        'priority_search' => 'boolean',
        'status' => 'boolean'
    ];
}
