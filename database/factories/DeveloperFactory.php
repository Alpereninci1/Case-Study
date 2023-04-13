<?php

namespace Database\Factories;

use App\Models\Developer;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeveloperFactory extends Factory
{
    protected $model = Developer::class;

    public function definition()
    {
        return [
            'name' => 'DEV'.$this->faker->numberBetween(1, 5),
            'duration' => 1,
            'difficulty' => $this->faker->numberBetween(1, 5)
        ];
    }
}
