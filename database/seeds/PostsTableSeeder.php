<?php

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'name' => 'News'
        ]);

        $category2 = Category::create([
            'name' => 'Marketing'
        ]);

        $category3 = Category::create([
            'name' => 'Partnership'
        ]);

        $category4 = Category::create([
            'name' => 'Design'
        ]);

        $author1 = User::create([

            'name' => 'Sunil',
            'email' => 'suni@gmail.com',
            'password' => Hash::make('a')
        ]);

        $author2 = User::create([

            'name' => 'Nimal',
            'email' => 'n@gmail.com',
            'password' => Hash::make('a')
        ]);

        $author3 = User::create([

            'name' => 'Kasun',
            'email' => 'k@gmail.com',
            'password' => Hash::make('a')
        ]);

        $post1 = Post::create([

            'title' => 'We relocated our office to a new designed garage',

            'description' => 'It is a long established fact that a reader will be distracted by the readable'.
                               'content of a page when looking at its layout. The point of u',

            'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have' .
                            'suffered alteration in some form, by injected humour, or randomised words which don\'t'.
                            'look even slightly believable. If you are going to use a passage of Lorem Ipsum, you'.
                            'need to be sure there isn\'t anything embarrassing hidden in the middle of text. All' .
                            'the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary',

            'image' => 'posts/10.jpg',

            'category_id' => $category1->id,

            'user_id' => $author1->id



        ]);

        $post2 = $author2->posts()->create([

            'title' => 'Congratulate and thank to Maryam for joining our team',

            'description' => 'It is a long established fact that a reader will be distracted by the readable'.
                'content of a page when looking at its layout. The point of u',

            'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have' .
                'suffered alteration in some form, by injected humour, or randomised words which don\'t'.
                'look even slightly believable. If you are going to use a passage of Lorem Ipsum, you'.
                'need to be sure there isn\'t anything embarrassing hidden in the middle of text. All' .
                'the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary',

            'image' => 'posts/11.jpg',

            'category_id' => $category2->id,

            //'user_id' => $author2->id


        ]);

        $post3 = $author3->posts()->create([

            'title' => 'New published books to read by a product designer',

            'description' => 'It is a long established fact that a reader will be distracted by the readable'.
                'content of a page when looking at its layout. The point of u',

            'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have' .
                'suffered alteration in some form, by injected humour, or randomised words which don\'t'.
                'look even slightly believable. If you are going to use a passage of Lorem Ipsum, you'.
                'need to be sure there isn\'t anything embarrassing hidden in the middle of text. All' .
                'the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary',

            'image' => 'posts/12.jpg',

            'category_id' => $category3->id,

            //'user_id' => $author3->id


        ]);

        $post4 = $author2->posts()->create([

            'title' => 'This is why it\'s time to ditch dress codes at work',

            'description' => 'It is a long established fact that a reader will be distracted by the readable'.
                'content of a page when looking at its layout. The point of u',

            'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have' .
                'suffered alteration in some form, by injected humour, or randomised words which don\'t'.
                'look even slightly believable. If you are going to use a passage of Lorem Ipsum, you'.
                'need to be sure there isn\'t anything embarrassing hidden in the middle of text. All' .
                'the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary',

            'image' => 'posts/13.jpg',

            'category_id' => $category4->id,

            //'user_id' => $author2->id



        ]);


        $tag1 = Tag::create([
            'name' => 'Record'
        ]);

        $tag2 = Tag::create([
            'name' => 'Offer'
        ]);

        $tag3 = Tag::create([
            'name' => 'Job'
        ]);



        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag3->id, $tag1->id]);
        $post4->tags()->attach([$tag1->id, $tag3->id]);



    }
}
