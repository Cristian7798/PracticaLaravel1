<?php

namespace Database\Seeders;

use App\Models\Model\Client;
use App\Models\Model\Invoice;
use App\Models\Model\Product;
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
        // \App\Models\User::factory(10)->create();
        Client::factory(10)->create();
        Product::factory(20)->create();
    }
}
