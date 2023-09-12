<?php
namespace App\Service;

use App\Models\AccountsBank;
use App\Models\CartDiscounts;
use App\Models\DiscountCodes;
use App\Models\Location\City;
use App\Models\Location\Country;
use App\Models\Location\State;
use App\Models\StatusDelivery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UtilsService 
{
    private StatusDelivery $statusDelivery;
    private Country $country;
    private State $state;
    private City $city;
    private AccountsBank $accountsBank;
    private DiscountCodes $discountCodes;
    private CartDiscounts $cartDiscount;


    public function __construct(
        StatusDelivery $statusDelivery,
        DiscountCodes $discountCodes,
        AccountsBank $accountsBank,
        CartDiscounts $cartDiscount,
        Country $country,
        State $state,
        City $city
    ) {
        $this->statusDelivery = $statusDelivery;
        $this->discountCodes = $discountCodes;
        $this->cartDiscount = $cartDiscount;
        $this->accountsBank = $accountsBank;
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
    }

    public function getMyCountry() {
        if(auth()->check()){
            $country = $this->country->find(auth()->user()->country_id);
        }else{
            $country = null;
        }
        if($country == null){
            $country = $this->country->first();
        }
        return $country;
    }


    public function getCountries() {
        return $this->country->all();
    }

    public function getStates($country_id) {
        return $this->state->where('country_id', $country_id)->get();
    }

    public function getCities($state_id) {
        return $this->city->where('state_id', $state_id)->get();
    }
    
    public function getStatusesDelivery() {
        return $this->statusDelivery->newQuery()->get();
    }
    public function findStatusDelivery($id) {
        return $this->statusDelivery->find($id);
    }
    public function getBankAccounts() {
        return $this->accountsBank->newQuery()->get();
    }

    public function discountList() {
        return $this->discountCodes->newQuery()
            ->withTrashed()
            ->get();
    }

    public function createDiscount(Request $request) {
        return $this->discountCodes->create([
            'code'          => strtoupper($request->input('code')),
            'expires'       => $request->expires,
            // 'allow_in',
            'attemps'       => $request->attemps,
            'expired_at'    => $request->expired_at,
            'users_used'    => 0,
            'percentage_discount'   => $request->percentage_discount,
        ]);
    }
    public function destoryDiscount($id) {
        $discount = $this->discountCodes->find($id);
        if($discount == null){
            return null;
        }
        $discount->delete();
        return true;
    }

    /**
     * Obtener código de descuento válido
     * @param $code
     * @param $user_id
     */
    public function allowDiscount($code, $user_id) {
        $codeEl = $this->discountCodes->where('code', strtoupper($code))->first();
        if($codeEl == null){
            return [
                'process'   => false,
                'message'   => 'El cupón no existe'
            ];
        }
        if($codeEl->expires == 1){
            if($codeEl->expired_at == null){
                return [
                    'process'   => false,
                    'message'   => 'Fecha de expiración no válida'
                ];
            }
            if($codeEl->expired_at < Carbon::now()){
                return [
                    'process'   => false,
                    'message'   => 'Código expirado'
                ];
            }
        }
        if($codeEl->attemps != -1){
            if($codeEl->attemps <= $codeEl->users_used){
                return [
                    'process'   => false,
                    'message'   => 'Código ya ha sido usado'
                ];
            }
        }
        $codeUsed = $this->cartDiscount->where('discount_id', $codeEl->id)
            ->where('user_id', $user_id)
            ->first();
        if($codeUsed != null){
            return [
                'process'   => false,
                'message'   => 'Usted ya ha usado este código'
            ];
        }

        return [
            'process'   => true,
            'message'   => '',
            'discount'      => $codeEl
        ];
    }

    public function addDiscountToCart($discount, $cart_id, $user_id) {
        $this->cartDiscount->create([
            'discount_id'   => $discount->id,
            'cart_shop_id'       => $cart_id,
            'user_id'       => $user_id,
            'code'          => $discount->code
        ]);
        $discount->users_used++; 
        $discount->save();
    }
}
