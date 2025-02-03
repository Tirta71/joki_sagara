<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Iqbalatma\LaravelServiceRepo\BaseService;

class AuthService extends BaseService
{
    public function register(array $data): User
    {
        $email = $data['email'];
        $whereClause = ['email' => $email];
        $columns = ['id', 'email'];

        $existingUser = AuthRepository::getSingleData($whereClause, $columns);
        if ($existingUser) {
            throw new \Exception("Email already exists");
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return AuthRepository::addNewData($data);
    }

    public function login(string $email, string $password): bool
    {
        $whereClause = ['email' => $email];
        $columns = ['id', 'email', 'name', 'password'];
        $user = AuthRepository::getSingleData($whereClause, $columns);

        if (!$user) {
            throw new ModelNotFoundException('Invalid Credentials');
        }

        if (Hash::check($password, $user->password)) {
            Auth::login($user);
            return true;
        }

        return false;
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
