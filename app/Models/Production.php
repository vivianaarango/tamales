<?php
namespace App\Models;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;

/**
 * Class Production
 * @property int id
 * @property integer lot
 * @property integer marmitas
 * @property integer broken
 * @property integer total
 * @property string date
 * @property integer created_by
 *
 * @property mixed first
 * @property mixed resource_url
 * @package App\Models
 * @method static create($data)
 * @method static findOrFail(int $productionID)
 * @method static select(string $string, string $string1, string $string2)
 * @method static orderBy(string $string, string $string1)
 */
class Production extends Model
{
    /**
     * @var string
     */
    protected $table = 'production';

    /**
     * @var string[]
     */
    protected $fillable = [
        'lot',
        'marmitas',
        'broken',
        'total',
        'date',
        'created_by'
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
        return url('/admin/production/'.$this->getKey());
    }
}
