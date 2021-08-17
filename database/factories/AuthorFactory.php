<?php

namespace Database\Factories;


use App\Models\Post;
use App\Models\User;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'user_id'=> User::all()->random()->id,
            'author'=> $this->faker->sentence(10),
            'about_author'=>$this->faker->sentence(20),
            'post_image'=> $this->faker->imageUrl('900','630'),


        ];
    }
}
