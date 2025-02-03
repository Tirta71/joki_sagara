<?php

namespace App\Services;

use App\Repositories\PasswordResetRepository;
use Exception;

class PasswordResetService
{
    protected $PasswordResetRepository;

    public function __construct(PasswordResetRepository $PasswordResetRepository)
    {
        $this->PasswordResetRepository = $PasswordResetRepository;
    }

    public function resetPassword(array $data)
    {
        $email = $data['email'];
        $new_password = $data['password'];

        // Menemukan user berdasarkan email
        $user = $this->PasswordResetRepository->findUserByEmail($email);

        if (!$user) {
            throw new Exception('Email tidak ditemukan');
        }


        // Update password user
        $this->PasswordResetRepository->updatePassword($user, $new_password);
    }
}
