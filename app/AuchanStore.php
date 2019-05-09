<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class AuchanStore extends Model
{
    protected $guarded = [];
    protected $table = 'auchan_stores';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public function prices()
    {
        return $this->hasMany('App\PetrolPrice', 'store_id');
    }
}