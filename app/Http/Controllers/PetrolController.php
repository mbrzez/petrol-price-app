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

    public function getPetrolPrices($id, Request $request) {
        $store = AuchanStore::findOrFail($id);
        $numResults = (int)$request->input('period') * 2;

        $priceWithStore = $store->prices()->orderBy('created_at', 'ASC')->limit($numResults)->get();

        return $priceWithStore;
    }
}
