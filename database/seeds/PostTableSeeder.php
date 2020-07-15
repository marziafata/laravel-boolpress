<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'title' => 'Ciao',
                'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magnam quas placeat voluptate laudantium perspiciatis, qui distinctio architecto dolore! Corporis fugiat suscipit tenetur explicabo asperiores similique non tempora saepe quidem delectus.',
                'slug' => 'ciao'
            ],
            [
                'title' => 'Gatto',
                'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magnam quas placeat voluptate laudantium perspiciatis, qui distinctio architecto dolore! Corporis fugiat suscipit tenetur explicabo asperiores similique non tempora saepe quidem delectus.',
                'slug' => 'gatto'
            ],
            [
                'title' => 'Cane',
                'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magnam quas placeat voluptate laudantium perspiciatis, qui distinctio architecto dolore! Corporis fugiat suscipit tenetur explicabo asperiores similique non tempora saepe quidem delectus.',
                'slug' => 'cane'
            ]
        ];

        foreach ($posts as $post) {
            $new_post = new Post();
            $new_post->title = $post['title'];
            $new_post->content = $post['content'];
            $new_post->slug = $post['slug'];
            $new_post->save();
        }
    }
}
