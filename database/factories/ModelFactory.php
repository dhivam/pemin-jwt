<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/*class ModelFactory extends Factory
{*/
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
   // protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
   
        $factory->define(User::class, function (Faker\Generator $faker){

            return [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => password_hash('123456', PASSWORD_BCRYPT)
            ];
    
    
    });

      
    
//}
