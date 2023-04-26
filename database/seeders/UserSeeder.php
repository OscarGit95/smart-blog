<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserInformation;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){
        $users = [
            'user_type_id' => 1,
            'status_id' => 1,
            'email' => 'admin@smartblog.com',
            'password' => bcrypt('smartadmin2023'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('users')->insert($users);

        $user_informations = [
            'user_id' => 1,
            'name' => 'Administrator',
            'last_name' => 'Smart Blog',
            'username' => 'SmartAdmin',
            'age' => 28,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_information')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('user_information')->insert($user_informations);

    }
}
