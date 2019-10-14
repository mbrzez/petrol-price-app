<?php

namespace App\Http\Controllers;

use App\AuchanStore;
use Illuminate\Http\Request;

class PetrolController extends Controller
{
    public function getAuchanStores(Request $request) {
        $stores = AuchanStore::all();

        if ($request->has('petrol_station')) {
            $petrolStation = $request->get('petrol_station');
            return $stores->where('petrol_station', '=', $petrolStation);
        }

        return $stores;
    }

    public function getPetrolPrices($extId, Request $request) {
        $store = AuchanStore::where('external_id', $extId)->first();
        $numResults = (int)$request->input('maxResults');

        $priceWithStore = $store->prices()->orderBy('created_at', 'DESC')->limit($numResults)->get();

        return $priceWithStore;
    }
}
