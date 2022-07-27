<?php

namespace App\Models\Relationships;

use App\Models\ClientUser;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ClientRelationship
{
    /**
     * @return HasMany
     */
    public function clientUser(): HasMany
    {
        return $this->hasMany(ClientUser::class);
    }
}
