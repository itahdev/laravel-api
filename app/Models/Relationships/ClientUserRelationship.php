<?php

namespace App\Models\Relationships;

use App\Models\Client;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ClientUserRelationship
{
    /**
     * @return BelongsTo
     */
    public function clientUser(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
