<?php
namespace App\Service;

use App\Models\Location\City;
use App\Models\Location\Country;
use App\Models\Location\State;
use App\Models\StatusDelivery;

class UtilsService 
{
    private StatusDelivery $statusDelivery;
    private Country $country;
    private State $state;
    private City $city;


    public function __construct(
        StatusDelivery $statusDelivery,
        Country $country,
        State $state,
        City $city
    ) {
        $this->country = $country;
        $this->statusDelivery = $statusDelivery;
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
}
