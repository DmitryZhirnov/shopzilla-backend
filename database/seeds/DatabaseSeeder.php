<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->truncate();
        // factory(User::class)->create(
        //     [
        //         "email"=>"dmzhirnov@mail.ru",
        //         "password"=>Hash::make(App::environment("DB_PASSWORD"))
        //     ]
        // );
        $this->call(CategorySeeder::class);
        
        $this->call(DiscountSeeder::class);

    }
}
