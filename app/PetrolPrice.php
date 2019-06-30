<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetrolPrice extends Model
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
    protected $table = 'petrol_prices';

    /**
     * All hidden model's properties
     *
     * @var array
     */
    protected $hidden = ['id', 'store_id'];

    /**
     * All casted model's properties
     *
     * @var array
     */
    protected $casts = [
        'pb95' => 'double',
        'pb98' => 'double',
        'diesel' => 'double',
        'lpg' => 'double'
    ];

    /**
     * Defines relation between PetrolPrice and AuchanStore
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo('App\AuchanStore');
    }
}