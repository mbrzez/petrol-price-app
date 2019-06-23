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

    public function getPetrolPrices($id) {
        $store = AuchanStore::findOrFail($id);
        $priceWithStore = $store->prices()->orderBy('created_at', 'DESC')->get();

        return $priceWithStore;
    }
}
