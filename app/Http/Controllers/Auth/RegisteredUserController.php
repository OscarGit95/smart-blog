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
