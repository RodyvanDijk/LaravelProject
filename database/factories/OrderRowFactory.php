<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderRow>
 */
class OrderRowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::all()->random()->id,
            'game_id' => Game::all()->random()->id,
            'quantity' => rand(1,9)
        ];
    }
}
