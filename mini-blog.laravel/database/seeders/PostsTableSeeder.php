<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'posts' => 'こんにちは。',
            'user_id' => '1',
            'is_reply' => '0',
        ];
        DB::table('posts')->insert($param);
    }
}
