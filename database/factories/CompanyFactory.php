<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){
        $now = now();
        return [
            'title' => 'Company "' . $this->faker->unique(true)->company . '"',
            'phone' => rand(1, 10000000),
            'email' => $this->faker->unique(true)->safeEmail,
            'email_verified_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }
}
