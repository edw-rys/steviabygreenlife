<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private UserService $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }
    public function registerShow() {
        return view('front.pages.auth.register');
    }
    public function loginShow() {
        return view('front.pages.auth.login');
    }
    public function forgorYourPasswordShow() {
        return view('front.pages.auth.login');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request) {
        $request->validate([
            'email'         => ['required', 'email'],
            'password'         => ['required'],
        ]);
        $request->merge([
            'email' => trim ( $request->input('email'))
        ]);
        return $this->userService->login($request);
    }
    public function signup(StoreUserRequest $request) {
        $user = $this->userService->create($request);
        return redirect()->route('auth.login')
            ->with('title_success', 'Usuario ha sido creado, por favor inicie sesión');
    }

    /**
     * Elimina sesion y redirecciona al login
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(){
        Auth::logout();
        return redirect()->route('front.shop')
            ->with('delete_shop', 'delete');
    }
}
