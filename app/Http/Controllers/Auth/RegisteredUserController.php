<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInformation;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\RegisterUserRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    //Esta crea un usuario y valida informacion 
    /**
     * Crear un usuario
     * @OA\Post (
     *     path="/register",
     *     tags={"Register"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                  @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Adolfo"
     *                     ),
     *                      @OA\Property(
     *                         property="last_name",
     *                         type="string",
     *                         example="Ruiz"
     *                     ),
     *                      @OA\Property(
     *                         property="username",
     *                         type="string",
     *                         example="AdolfoR30"
     *                     ),
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
     *                     @OA\Property(
     *                         property="password_confirmation",
     *                         type="string",
     *                         example="adolfo123"
     *                     ),
     *                     @OA\Property(
     *                         property="age",
     *                         type="number",
     *                         example="30"
     *                     ),
     *                 )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=500,
     *          description="SERVER ERROR",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Ocurrió un problema al registrarte. Contacta a soporte técnico"),
     *          )
     *      )
     *   )
     * )
     */
    public function store(RegisterUserRequest $request): RedirectResponse
    {
        try{
            DB::beginTransaction();
            $user = User::create([
                'user_type_id' => 2,
                'status_id' => 1,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $userInfo = UserInformation::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'age' => $request->age,
            ]);
    
            event(new Registered($user));
            
            Auth::login($user);
            DB::commit();
            return redirect(RouteServiceProvider::HOME);
        }catch(\Throwable $th){
            DB::rollback();
            return back()->with('errors', 'Ocurrió un problema al registrarte. Contacta a soporte técnico');
        }
    }
}
