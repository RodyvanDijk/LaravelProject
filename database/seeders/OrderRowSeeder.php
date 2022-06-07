<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderRow;
use Database\Factories\OrderRowFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderRowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderRow::factory()
            ->times(10)
            ->create();
    }
}
