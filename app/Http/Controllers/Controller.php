<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

abstract class Controller
{
    public function handleError(\Exception $exception): RedirectResponse
    {
        return redirect()->back()->withErrors(['error' => 'Internal Server Error']);
    }
}
