<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'taro',
            'email' => 'taro@yamada.jp',
            'password' => 'passwordtaro',
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'hanako',
            'email' => 'hanako@flower.jp',
            'password' => 'passwordhanako',
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'sachiko',
            'email' => 'sachiko@happy.jp',
            'password' => 'passwordsachiko',
        ];
        DB::table('users')->insert($param);
    }
}
