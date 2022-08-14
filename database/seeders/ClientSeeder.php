<?php

namespace Database\Seeders;

use Database\Seeders\Traits\TruncateTable;
use App\Models\Client;
use App\Models\ClientUser;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->truncateMultiple([
            'clients',
            'client_users',
        ]);

        Client::factory(20)
            ->has(ClientUser::factory(1000))
            ->create();
    }
}
