<?php

namespace Database\Seeders;

use App\Models\Admin;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
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
            'admins',
        ]);

        Admin::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);
    }
}
