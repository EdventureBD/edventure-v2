<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $is_admin = rand(1, 0);
        if ($is_admin == 1) {
            $user_type = 1;
        } else {
            $user_type = rand(2, 3);
        }
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // password
            'is_admin' => $is_admin,
            'user_type' => $user_type,
            'image' => null,
        ];
    }
}
