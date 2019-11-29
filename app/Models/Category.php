<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\{Builder, Model};

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name Category name
 * @property string|null $description Category description
 * @property int $post_count The number of posts under the category
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereDescription($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereName($value)
 * @method static Builder|Category wherePostCount($value)
 * @mixin Eloquent
 */
class Category extends Model
{
    // created_at and updated_at do not need to be changed for either creation or updating.
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];
}
