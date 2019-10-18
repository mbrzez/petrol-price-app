<?php

namespace App;

use App\Utils\DateZonedFormatter;
use Illuminate\Database\Eloquent\Model;

class PetrolPrice extends Model
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
     * PetrolPrice constructor
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->formatter = new DateZonedFormatter(new \DateTimeZone('UTC'), 'Y-m-d H:i');
    }

    /**
     * Defines relation between PetrolPrice and AuchanStore
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo('App\AuchanStore');
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->formatter->formatValue($value,
            new \DateTimeZone('Europe/Warsaw')
        );
    }

    public function getCreatedAtAttribute($value)
    {
        return $this->formatter->formatValue($value,
            new \DateTimeZone('Europe/Warsaw')
        );
    }
}