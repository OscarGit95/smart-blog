<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UserType;
use Carbon\Carbon;


class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){
        // create user types and truncate table
        $user_types = [
            [
                'status_id' => 1,
                'name' => 'Admin',
                'created_at' =>  Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status_id' => 1,
                'name' => 'User',
                'created_at' =>  Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_types')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('user_types')->insert($user_types);

    }
}
