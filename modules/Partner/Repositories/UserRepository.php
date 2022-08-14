<?php

namespace Modules\Partner\Repositories;

use App\Enums\UserStatus;
use App\Models\ClientUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserRepository
{
    public function testQuery(): void
    {
        DB::enableQueryLog();
        // query 0 + 1
        $eloquent = ClientUser::query()
            ->with('client', fn($query) => $query->whereIn('id', [1,2]))
            ->select('id', 'client_id')
            ->whereBetween('id', [1, 500])
            ->orderBy('id')
            ->get();

        // query 2
        $queryBuilder = DB::table('client_users')
            ->select('id', 'client_id')
            ->whereBetween('id', [1, 500])
            ->orderBy('id')
            ->get();

        // query 3
        $dbRaw = DB::table('client_users')
            ->select('id', 'client_id')
            ->whereRaw('id = ?', ['2 or 1=1'])
            ->get();

        // query 4
        $insert = ClientUser::query()->create([
            'client_id' => 1,
            'name' => 'name',
            'email' => Str::random(20),
            'password' => 'password',
            'phone_number' => '0989748373',
            'status' => UserStatus::ACTIVE->value,
        ]);

        dd(DB::getQueryLog(), $dbRaw);
    }
}
