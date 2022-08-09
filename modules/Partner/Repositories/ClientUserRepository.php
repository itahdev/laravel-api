<?php

namespace Modules\Partner\Repositories;

use App\Models\ClientUser;

class ClientUserRepository
{
    /**
     * @param int $id
     * @return ClientUser
     */
    public function findOrFailById(int $id): ClientUser
    {
        return ClientUser::with(['channel'])
            ->has('channel')
            ->findOrFail($id);
    }
}
