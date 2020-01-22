<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        factory(User::class)->create(
            [
                "email"=>"dmzhirnov@mail.ru",
                "password"=>Hash::make(App::environment("DB_PASSWORD"))
            ]
        );
    }
}
