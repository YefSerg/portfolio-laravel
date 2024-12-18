<?php

namespace Database\Seeders;

use App\Models\PolyReview;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(15)->create();

        $projects = Project::factory(15)->withLoremImage()->create();

        $projects->take(3)->each(function ($project) {
            PolyReview::factory(5)->for($project, 'reviewable')->create();
        });
    }
}
