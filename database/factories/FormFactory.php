<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Form;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Form::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'description' => $faker->text(),
        'has_random_questions' => $faker->boolean(),
        'accept_answers' => $faker->boolean(),
        'created_at' => $faker->dateTime(),
        'created_by' => User::inRandomOrder()->first()
    ];
});
