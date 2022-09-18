<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker;

/**
 * @extends Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = \App\Models\User::factory()->create();
        return [
            'title'       => $this->faker->text(30),
            'author'      => $this->faker->name(),
            'create_date' => $this->faker->numberBetween(1800, 2022),
            'user_id'     => $user->id
        ];
    }
}
