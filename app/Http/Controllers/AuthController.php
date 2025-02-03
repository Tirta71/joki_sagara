<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
    protected $service;

    // public function forgotPassword(){
    //     return view('auth.forgot');
    // }

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterRequest $request) : RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->service->register($validated);

            return redirect()->route('login')->with('status', 'Registration successful');
        } catch (\Exception $e) {
            if ($e->getMessage() === 'Email already exists') {
                return redirect()->back()->withErrors(['email' => 'This email is already registered.']);
            }

            return $this->handleError($e);
        }
    }

    public function login(LoginRequest $request) : RedirectResponse
    {
        try {
            $validated = $request->validated();
            $success = $this->service->login($validated['email'], $validated['password']);

            if (!$success) {
                return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
            }

            return redirect()->route('dashboard')->with('status', 'Login successful');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function logout() : RedirectResponse
    {
        try {
            $this->service->logout();

            return redirect()->route('/')->with('status', 'Logout successful');
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }
}
