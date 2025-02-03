<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PasswordResetRepository
{
    public function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function updatePassword(User $user, $newPassword)
    {
        $user->password = Hash::make($newPassword);
        $user->save();
    }
}
