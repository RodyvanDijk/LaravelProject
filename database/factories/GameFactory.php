<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'game' => $this->faker->name,
            'description' => $this->faker->paragraph(15),
            'category_id' => Category::all()->random()->id,
            'price' => $this->faker->randomFloat(2, 2, 20),
            'created_at'=>$this->faker->dateTimeThisDecade('now', 'Europe/Amsterdam'),
            'updated_at'=>$this->faker->dateTimeThisDecade('now', 'Europe/Amsterdam')
        ];
    }
}
