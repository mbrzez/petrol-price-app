<?php

namespace App;

use App\Utils\DateFormatUtils;
use App\Utils\DateZonedFormatter;
use Illuminate\Database\Eloquent\Model;

class AuchanStore extends Model
{
    /**
     * DateZonedFormatter
     *
     * @var App\Utils\DateZonedFormatter
     */
    private $formatter;

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
    protected $hidden = ['sub_url', 'created_at', 'updated_at'];


    /**
     * AuchanStore constructor
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->formatter = new DateZonedFormatter(new \DateTimeZone('UTC'), 'Y-m-d H:i');
    }

    /**
     * Defines relation between AuchanStore and PetrolPrice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prices()
    {
        return $this->hasMany('App\PetrolPrice', 'store_id');
    }

    public function getUpdatedAtAttribute(string $value)
    {
        return $this->formatter->formatValue($value,
            new \DateTimeZone('Europe/Warsaw')
        );
    }

    public function getCreatedAtAttribute(string $value)
    {
        return $this->formatter->formatValue($value,
            new \DateTimeZone('Europe/Warsaw')
        );
    }
}