<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name'           => 'Free',
                'price_monthly'  => 0,
                'max_users'      => 2,
                'max_products'   => 100,
                'max_branches'   => 1,
                'features'       => json_encode(['pos', 'basic_report']),
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Pro',
                'price_monthly'  => 299000,
                'max_users'      => 10,
                'max_products'   => 99999,
                'max_branches'   => 3,
                'features'       => json_encode(['pos', 'full_report', 'export', 'warehouse']),
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Business',
                'price_monthly'  => 699000,
                'max_users'      => 99999,
                'max_products'   => 99999,
                'max_branches'   => 99999,
                'features'       => json_encode(['pos', 'full_report', 'export', 'warehouse', 'pawn', 'api', 'crm']),
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ];

        DB::table('plans')->insert($plans);
    }
}