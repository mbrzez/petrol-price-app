<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuchanStore extends Model
{
    /**
     * Explicit guarded model's properties
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Explicit model's table name
     *
     * @var string
     */
    protected $table = 'auchan_stores';

    /**
     * All hidden model's properties
     *
     * @var array
     */
    protected $hidden = ['id', 'external_id', 'sub_url'];


    /**
     * Defines relation between AuchanStore and PetrolPrice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prices()
    {
        return $this->hasMany('App\PetrolPrice', 'store_id');
    }
}