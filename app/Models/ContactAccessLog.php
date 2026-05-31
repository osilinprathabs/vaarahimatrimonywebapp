<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactAccessLog extends Model
{
    use HasFactory;

    protected $table = 'contact_access_logs';

    protected $fillable = [
        'viewer_id',
        'profile_id',
        'interest_id',
        'viewed_time',
        'mobile_viewed',
        'email_viewed',
    ];

    public function viewer()
    {
        return $this->belongsTo(User::class, 'viewer_id', 'id');
    }

    public function profileOwner()
    {
        return $this->belongsTo(User::class, 'profile_id', 'id');
    }

    public function interest()
    {
        return $this->belongsTo(Interest::class, 'interest_id', 'id');
    }
}
