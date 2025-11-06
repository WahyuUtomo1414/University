<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 1; // agar nomor berurutan

        // Buat nomor student otomatis
        $studentNumber = 'ST-' . str_pad($counter++, 6, '0', STR_PAD_LEFT);

        // Gunakan Faker Indonesia
        $faker = \Faker\Factory::create('id_ID');

        return [
            'student_number' => $studentNumber,
            'name' => $faker->name,
            'born' => $faker->dateTimeBetween('-25 years', '-18 years')->format('Y-m-d'),
            'street' => $faker->streetAddress,
        ];
    }
}
