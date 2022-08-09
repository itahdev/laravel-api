<?php

namespace App\Models\Relationships;

use App\Models\Channel;
use App\Models\Client;
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
    public function channel(): HasOne
    {
        return $this->hasOne(Channel::class, 'client_user_id');
    }
}
