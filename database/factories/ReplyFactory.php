<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {        
        return [
            'body' => $this->faker->text(),
            'question_id' => function(){
                return Question::all()->random();
            },
            'user_id'=> function(){
                return User::all()->random();
            },
        ];
    }
}
