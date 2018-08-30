<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use Sluggable;

    protected $table = 'pages';

    protected $fillable = [
        'title',
        'url',
        'position',
        'h1',
        'description',
        'keywords'
    ];

    static public function create($fields)
    {
        $position = Pages::max('position');
        $position = ($position == 0) ? 1 : ($position + 1);
        $arrPosition['position'] = $position;

        $fields = array_merge($fields, $arrPosition);

        $pages = new Pages();
        $pages->fill($fields);
        $pages->save();
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
