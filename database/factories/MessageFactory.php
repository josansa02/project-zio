<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $imgs = [];
        foreach (Image::where('user_id', 1)->get() as $img) {
            $imgs[] = $img->id;
        }
        $users = User::pluck('id')->toArray();
        unset($users[0]);

        return [
            'message' => $this->faker->sentence(),
            'owner_id' => 1,
            'writer_id' => $this->faker->randomElement($users),
            'img_id' => $this->faker->randomElement($imgs)
        ];
    }
}
