<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    private UserService $userService;
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    /**
     * Write code on Method
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showForgetPasswordForm()
    {
        return view('front.pages.auth.forgetPassword');
    }

    /**
     * Write code on Method
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        try {
            Mail::send('email.user.forgetPassword', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Restablecer mi contraseña');
            });
        } catch (\Throwable $th) {
            Log::error($th->getMessage().': ForgotPasswordController::submitForgetPasswordForm', [
                'message'   => $th->getMessage(),
                'code'      => $th->getCode(),
                'line'      => $th->getLine(),
                'trace'     => $th->getTrace()
            ]);
            return back()->with('error_message', 'No hemos podido enviar su el correo electrónico, vuelva a intentarlo más tarde.');
        }

        return back()->with('message', '¡Le hemos enviado por correo electrónico el enlace para restablecer su contraseña!');
    }
    /**
     * Write code on Method
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showResetPasswordForm($token)
    {
        $passwordReset = DB::table('password_resets')
            ->where([
                'token' => $token
            ])
            ->first();
        if($passwordReset == null){
            abort(404);
        }

        return view('front.pages.auth.forgetPasswordLink', ['token' => $token, 'passwordReset'=> $passwordReset]);
    }

    /**
     * Write code on Method
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $this->userService->updatePassword($request, $updatePassword->email);

        DB::table('password_resets')->where(['email' => $updatePassword->email])->delete();

        return redirect()->route('auth.login')->with('title_success', '¡Tu contraseña ha sido cambiada!');
    }
}