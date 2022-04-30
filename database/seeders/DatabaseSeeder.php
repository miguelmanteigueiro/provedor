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
        $USER_SEED_QUANTITY = 200;
        \App\Models\User::factory($USER_SEED_QUANTITY)->create();
        
        $SEED_QUANTITY = 0;
        #\App\Models\Solicitacao::factory($SEED_QUANTITY)->create();
        #\App\Models\Assunto::factory()->create();
    }
}
