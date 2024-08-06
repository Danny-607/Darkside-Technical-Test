<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'customer_email' => 'd@d.com',
                'phone_number' => '12345678901',
                'address_line_1' => '123 Fake Street',
                'address_line_2' => 'Fakeville',
                'city' => 'Faketown',
                'county' => 'Fakeshire',
                'postcode' => 'FA1 2KE',
            ],

        ];
        DB::table('customers')->insert($customers);
    }
}
