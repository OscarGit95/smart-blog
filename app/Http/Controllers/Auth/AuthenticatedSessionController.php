<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

    /**
     * Inicio de sesión
     * @OA\Post (
     *     path="/login",
     *     tags={"Login"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                  @OA\Items(
     *                     type="object",
     *                    @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="adolfor@smartblog.com"
     *                     ),
     *                    @OA\Property(
     *                         property="password",
     *                         type="string",
     *                         example="adolfo123"
     *                     ),
     *                 )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=500,
     *          description="SERVER ERROR",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Ocurrió un problema al iniciar sesión. Contacta a soporte técnico"),
     *          )
     *      )
     *   )
     * )
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
