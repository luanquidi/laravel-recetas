<?php

use App\Perfil;
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
        $this->call(CategoriasSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(PerfilSeeder::class);
        // $this->call(UserSeeder::class);
    }
}
