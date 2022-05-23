<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'created_at'=>$this->faker->dateTimeThisDecade('now', 'Europe/Amsterdam'),
            'updated_at'=>$this->faker->dateTimeThisDecade('now', 'Europe/Amsterdam')
        ];
    }
}
