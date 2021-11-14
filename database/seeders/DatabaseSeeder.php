<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use function PHPUnit\Framework\callback;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
    }
}
