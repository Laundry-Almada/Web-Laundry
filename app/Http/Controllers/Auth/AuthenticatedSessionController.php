<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user = Auth::user();

        // Determine redirect path based on role
        $redirectPath = match($user->role) {
            'admin' => '/admin/dashboard',
            'staff' => '/dashboard',
            default => '/'
        };

        return response()->json([
            'role' => $user->role,
            'redirect' => $redirectPath
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
