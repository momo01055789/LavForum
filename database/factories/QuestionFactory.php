<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'body' => $this->faker->text(),
            'category_id' => function(){
                return Category::all()->random();
            },
            'user_id'=> function(){
                return User::all()->random();
            },
        ];
    }
}
