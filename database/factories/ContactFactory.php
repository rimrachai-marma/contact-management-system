<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ContactFactory extends Factory {
    public function definition(): array {
        return [
            "first_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "user_id" => "696da4f8-916e-4194-8909-d09b6c08f644", //User::inRandomOrder()->first()->id,
            "phone" => fake()->phoneNumber(),
            "email" => fake()->email(),
            "address" => fake()->address(),
            "dob" => fake()->date(),
            "notes" => "Some notes about the contact",
            "started" => fake()->boolean()
        ];
    }
}


// > php artisan tinker
// > use App\Models\Contact
// > Contact::factory()->count(50)->create()