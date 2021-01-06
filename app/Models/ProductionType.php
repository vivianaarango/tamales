<?php
namespace App\Models;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;

/**
 * Class ProductionType
 * @property int id
 * @property integer production_id
 * @property integer type_id
 * @property integer quantity
 *
 * @property mixed first
 * @package App\Models
 * @method static create($productionType)
 * @method static where(string $string, int $productionID)
 * @method static findOrFail(int $productionTypeID)
 */
class ProductionType extends Model
{
    /**
     * @var string
     */
    protected $table = 'production_types';

    /**
     * @var string[]
     */
    protected $fillable = [
        'production_id',
        'type_id',
        'quantity'
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var string[]
     */
    protected $appends = ['resource_url'];

    /**
     * @return UrlGenerator|Application|string
     */
    public function getResourceUrlAttribute()
    {
        return url('/admin/production-type/'.$this->getKey());
    }
}
