<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Utilizador::factory(2)->create();
        \App\Models\Solicitacao::factory(50)->create();
    }
}
