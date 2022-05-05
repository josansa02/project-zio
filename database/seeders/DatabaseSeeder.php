<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Image;
use App\Models\Message;
use App\Models\Petitions;
use App\Models\Report;
use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        Image::factory(5)->create();
        Message::factory(5)->create();
        Vote::factory(5)->create();
        Report::factory(5)->create();
        Petitions::factory(5)->create();
    }
}
