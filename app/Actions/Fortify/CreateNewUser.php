<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Models\Customer;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */ 

    public function create(array $data)
    {
        // Save user to the users table first
        $user = User::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        // Then save additional customer info to the customers table
        Customer::create([
            'user_id' => $user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'province' => $data['province'],
            'city_municipality' => $data['city_municipality'],
            'barangay' => $data['barangay'],
            'street' => $data['street'],
            'postal_code' => $data['postal_code'],
            'phone' => $data['phone'],
        ]);

        return $user;
    }

}
