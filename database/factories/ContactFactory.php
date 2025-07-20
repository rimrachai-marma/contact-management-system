<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ContactFactory extends Factory {
    public function definition(): array {
        return [
            "first_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "user_id" => "050ff9ff-d204-483d-809f-78b6ccaf6653", //User::inRandomOrder()->first()->id,
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