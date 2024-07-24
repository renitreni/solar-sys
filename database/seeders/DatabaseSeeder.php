<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\GlobalParameter;
use App\Models\JobStatus;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Builder\Property;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        GlobalParameter::query()->insert([
            ['param_name' => 'company-logo', 'param_value' => null],
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory(40)->create();
        Client::factory(20)->create();
        JobStatus::factory(20)->create();
        Service::factory(20)->create();
        Project::factory(50)->create();
    }
}
