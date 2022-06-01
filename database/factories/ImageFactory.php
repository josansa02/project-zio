<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        return [
            'img_name' => $this->faker->image('public/img/usersIMG',640,480, null, false),
            'title' => $this->faker->text(20),
            'footer' => $this->faker->text(30),
            'user_id' => $this->faker->randomElement($users)
        ];
    }
}
