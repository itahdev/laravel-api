<?php

namespace App\Models\Relationships;

use App\Models\Client;
use App\Models\NotificationChannel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait ClientUserRelationship
{
    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return HasOne
     */
    public function notificationChannel(): HasOne
    {
        return $this->hasOne(NotificationChannel::class);
    }
}
