<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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
        $data = [];

        for ($i = 1; $i <= 7; $i++) {
            $data[] = [
                'title' => 'Contoh Konten ' . $i,
                'slug' => 'contoh-konten-' . $i,
                'thumbnail' => '/storage/photos/1/wp.jpg',
                'description' => 'HTML adalah singkatan dari Hypertext Markup Language',
                'content' => 'HTML adalah singkatan dari Hypertext Markup Language ABCDE fghijklmnopqrstuvwxyz',
                'status' => 'publish',
                'views_count' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => 1,
            ];
        }

        DB::table('posts')->insert($data);
    }
}
