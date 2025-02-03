<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequeset;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Services\PasswordResetService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    protected $passwordResetService;

    public function __construct(PasswordResetService $passwordResetService)
    {
        $this->passwordResetService = $passwordResetService;
    }

    public function reset(PasswordResetRequest $request) : RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->passwordResetService->resetPassword($validated);

            return redirect()->route('login')->with('success', 'Password berhasil diubah');
        } catch (Exception $e) {
            return back()->withErrors(['email' => $e->getMessage()]);
        }
    }
}
