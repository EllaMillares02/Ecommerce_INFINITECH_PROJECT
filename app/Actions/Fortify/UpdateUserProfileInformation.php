<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input 
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:15'],
        ])->validateWithBag('updateProfileInformation');

        // Update name and email in `users` table
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
        ])->save();

        // Update the address in the `customer` table
        $customer = Customer::where('user_id', $user->id)->first();
        if ($customer) {
            $customer->update([
                'street' => $input['street'] ?? $customer->street,
                'barangay' => $input['barangay'] ?? $customer->barangay,
                'city_municipality' => $input['city_municipality'] ?? $customer->city_municipality,
                'province' => $input['province'] ?? $customer->province,
                'postal_code' => $input['postal_code'] ?? $customer->postal_code,
            ]);
        }
    }
    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
            'address' => $input['address'], // Add this line
            'phone' => $input['phone'], 
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
