<?php

namespace Database\Factories\Admin\MasterData;

use App\Models\Admin\MasterData\DeviceBrand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\MasterData\DeviceBrand>
 */
class DeviceBrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = DeviceBrand::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'category' => $this->faker->randomElement(['Laptop', 'Komputer', 'Aplikasi', 'Network Device', 'Monitor', 'Printer']),
        ];
    }
}
