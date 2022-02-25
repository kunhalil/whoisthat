<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
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
        User::factory()->create([
            'name' => 'Joe Blogs',
            'email' => 'joeblogs@example.com',
        ]);

        User::factory(5)->create();

        $companies = Company::factory(100)->create();

        Contact::factory(100)
            ->create()
            ->each(function ($contact) use ($companies) {
                $contact->update(['company_id' => $companies->random()->id]);
            });
    }
}
