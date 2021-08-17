<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'user_id'=> User::all()->random()->id,
            'title'=> $this->faker->sentence(30),
            'category'=> $this->faker->sentence(15),
            'post_image'=> $this->faker->imageUrl('900','630'),
            'body'=> $this->faker->paragraphs(300),

        ];
    }
}
