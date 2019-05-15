<?php

namespace App\Http\Controllers;

use App\AuchanStore;

class PetrolController extends Controller
{
    public function getAllPetrolPrices() {
        $storesWithPrices = AuchanStore::with('prices')->where('petrol_station', '=', 1)->get();

        return $storesWithPrices;
    }

    public function getPetrolPricesForStore($id) {
        $store = AuchanStore::findOrFail($id);
        $priceWithStore = $store->prices()->latest()->get();

        return $priceWithStore;
    }
}
