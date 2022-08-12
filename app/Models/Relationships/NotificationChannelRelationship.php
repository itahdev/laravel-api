<?php

namespace App\Models\Relationships;

use App\Models\ClientUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait NotificationChannelRelationship
{
    /**
     * @return BelongsTo
     */
    public function clientUser(): BelongsTo
    {
        return $this->belongsTo(ClientUser::class);
    }
}
