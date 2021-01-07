<?php
namespace App\Models;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;

/**
 * Class Type
 * @property int id
 * @property string name
 *
 * @package App\Models
 * @method static create($data)
 */
class Type extends Model
{
    /**
     * @var string
     */
    protected $table = 'types';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name'
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
        return url('/admin/type/'.$this->getKey());
    }
}
