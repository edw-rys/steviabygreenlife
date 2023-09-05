<?php
namespace App\Service;

use App\Models\ClientEventsViewsSystem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class UserService
{

    private User $user;

    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    /**
     * @param Request $request
     */
    public function login(Request $request) {
        $credentials = $request->only('email','password');
       
        if(Auth::attempt($credentials)){

            return redirect()->route('front.shop');
        }
        $viewErrorBag = new MessageBag();
        $viewErrorBag->add('authentication', 'Datos Incorrectos');

        return redirect()->route('auth.login')->withErrors($viewErrorBag);
    }

    /**
     * @param Request $request
     * @param $automatic
     */
    public function create(Request $request, $automatic = 0) {
        $user = $this->user->create([
            'name'          => $request->input('name'), 
            'last_name'     => $request->input('last_name'), 
            'email'         => $request->input('email'), 
            'password'      => bcrypt($request->input('password')),
            'automatic'     => $automatic,
            'email_shop'    => $request->input('email_shop'),
            'country_id'    => 1
        ]);
        return $user;
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id) {
        $user = $this->user->find($id);
        if($user == null){
            return null;
        }
        $user->country_id = $request->country_id;
        $user->city_id = $request->city_id;
        $user->state_id = $request->state_id;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->identification_number = $request->identification_number;
        $user->save();
        return $user;
    }

    /**
     * @param $id
     * @param $lastPassword
     * @param $newPassword
     */
    public function updateMyPassword($id, $lastPassword, $newPassword) {
        $user = $this->user->find($id);
        if($user == null){
            return (object)[
                'data'      => null,
                'message'   => 'Perfil no existe',
                'key_status'    => 'title_error',
                'status'    => 'error'
            ];
        }
        $check = password_verify($lastPassword, $user->password);
        if(!$check){
            return (object)[
                'data'      => null,
                'message'   => 'Contraseña incorrecta',
                'key_status'    => 'title_error',
                'status'    => 'error'
            ];
        }
        $user->password = bcrypt($newPassword);
        $user->save();
        return (object)[
            'data'      => $user,
            'message'   => 'Se ha cambiado la contraseña',
            'key_status'    => 'title_success',
            'status'    => 'success'
        ];
    }
    /**
     * @param Request $request
     * @param $email
     */
    public function updatePassword($request, $email)  {
        $this->user->where('email', $email)
            ->update(['password' => bcrypt($request->password)]);
    }
    /**
     * @param $user_id
     */
    public function getCityByUserId($user_id) {
        $user = $this->user->with('city')->find($user_id);
        return $user != null ? $user->city : null;
    }
}
