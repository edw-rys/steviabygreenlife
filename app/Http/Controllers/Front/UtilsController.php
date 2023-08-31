<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Service\UserService;
use App\Service\UtilsService;
use Illuminate\Http\Request;

class UtilsController extends Controller
{
    private UtilsService $utilsService;

    /**
     * @param UtilsService $utilsService
     * @param UserService $userService
     */
    public function __construct(UtilsService $utilsService) {
        $this->utilsService = $utilsService;
    }

    public function getCountries() {
        return response()->json(
            [
                'data'  => $this->utilsService->getCountries()
            ]
        );
    }

    public function getStates($country_id) {
        return response()->json(
            [
                'data'  => $this->utilsService->getStates($country_id)
            ]
        );
    }


    public function getCities($state_id) {
        return response()->json(
            [
                'data'  => $this->utilsService->getCities($state_id)
            ]
        );
    }
}
