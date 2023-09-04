<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Service\ClientService;
use App\Service\UserService;
use App\Service\UtilsService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;
    private UtilsService $utilsService;
    private ClientService $clientService;
    

    /**
     * @param UtilsService $utilsService
     * @param UserService $userService
     * @param ClientService $clientService
     */
    public function __construct(UtilsService $utilsService, UserService $userService, ClientService $clientService) {
        $this->userService = $userService;
        $this->utilsService = $utilsService;
        $this->clientService = $clientService;
    }

    public function profile() {
        $country = $this->utilsService->getMyCountry();
        $user = auth()->user();
        return view('front.pages.user.profile')
            ->with('country', $country)
            ->with('user', $user);
    }
    /**
     * @param UpdateUserRequest $request
     */
    public function updateProfile(UpdateUserRequest $request) {
        $request->validate(
            [
                'identification_number'     => ['nullable', 'numeric'],
            ]
        );
        $response = $this->userService->update($request, auth()->user()->id);
        if($response == null){
            abort(404);
        }
        return redirect()->back()
            ->with('title_success', 'Datos actualizados');
    }

    public function changePassword() {
        return view('front.pages.user.change-password');
    }

    /**
     * @param UpdatePasswordRequest $request
     */
    public function updatePassword(UpdatePasswordRequest $request) {
        $response = $this->userService->updateMyPassword(auth()->user()->id, $request->last_password, $request->password);
        return redirect()->back()
            ->with($response->key_status, $response->message);
    }

   
}
