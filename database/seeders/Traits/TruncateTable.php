<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait TruncateTable
{
    /**
     * @param string $table
     *
     * @return bool|void
     */
    protected function truncate(string $table)
    {
        return match (DB::getDriverName()) {
            'mysql' => DB::table($table)->truncate(),
            'pgsql' => DB::statement('TRUNCATE TABLE ' . $table . ' RESTART IDENTITY CASCADE'),
            'sqlite', 'sqlsrv' => DB::statement('DELETE FROM ' . $table),
            default => false,
        };
    }

    /**
     * @param array $tables
     * @return void
     */
    protected function truncateMultiple(array $tables): void
    {
        foreach ($tables as $table) {
            $this->truncate($table);
        }
    }
}
