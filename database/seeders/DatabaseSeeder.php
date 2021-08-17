<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Models\Author;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // User::factory(10)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();  // bila tidak ingin menyimpan data tabel user saat generate seed
        DB::table('posts')->truncate();  // bila tidak ingin menyimpan data tabel post saat generate seed
        DB::table('authors')->truncate();

        User::factory(10)->create()->each(function($user){
            $user->posts()->save(Post::factory()->make());
        });
    }
}
