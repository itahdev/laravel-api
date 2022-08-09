<?php

namespace App\Models;

use App\Models\Relationships\NotificationChannelRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $fcm_token
 */
class NotificationChannel extends Model
{
    use NotificationChannelRelationship,
        HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_user_id',
        'device_id',
        'device_os',
        'fcm_token',
    ];
}
