<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetrolPrice extends Model
{
    protected $guarded = [];
    protected $table = 'petrol_prices';

//    public function __construct(array $attributes = array())
//    {
//        parent::__construct($attributes);
//    }

    public function store()
    {
        return $this->belongsTo('App\AuchanStore');
    }
}