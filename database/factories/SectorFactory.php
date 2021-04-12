<?php

namespace Database\Factories;

use App\Models\Sector;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sector::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition(){
        $now = now();
        return [
            'title' => $this->faker->unique(true)->firstNameFemale,
            'parent_id' => NULL,
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }
}
