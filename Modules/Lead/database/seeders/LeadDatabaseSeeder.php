<?php

namespace Modules\Lead\Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class LeadDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $sources = ['manual', 'facebook', 'google', 'api', 'referral'];
        $statuses = ['new', 'contacted', 'qualified', 'proposal', 'closed', 'lost'];

        $companyIds = DB::table('saas_company')->pluck('company_id')->toArray();

        for ($i = 1; $i <= 1000; $i++) {
            DB::table('saas_leads')->insert([
                'lead_name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->phoneNumber(),
                'company_id' => $faker->randomElement($companyIds),
                'source' => $faker->randomElement($sources),
                'stage' => $faker->randomElement($statuses),
                'score' => $faker->numberBetween(0, 100),
                'notes' => $faker->sentence(10),

                'meta' => json_encode([
                    'industry' => $faker->randomElement(['IT', 'Finance', 'Health', 'Education', 'Retail']),
                    'value' => $faker->randomFloat(2, 1000, 50000),
                    'currency' => 'USD',
                    'contact_type' => $faker->randomElement(['person', 'organization']),
                ]),

                'assigned_to' => null,
                'created_by' => null,

                'contacted_at' => $faker->optional()->dateTimeThisYear(),
                'closed_at' => $faker->optional()->dateTimeThisYear(),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
