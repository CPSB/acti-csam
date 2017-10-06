<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent database model 'Categories'
 *
 * @property integer        $id             The primary key from the category in the db.
 * @property integer        $author_id      The id form the user who has created the category.
 * @property string         $color          The HEX value from the category.
 * @property string         $module         The module for the category.
 * @property string         $name           The name form the category.
 * @property string         $description    The description from the category.
 * @property \Carbon\Carbon $created_at     The timestamp when the category has been created.
 * @property \Carbon\Carbon $updated_at     The timestamp when the category last has been updated.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\ActivismeBE\User[] $author
 */
class Categories extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'color', 'module', 'name', 'description'];

    /**
     * Data relation for the author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id')
            ->withDefault(['name' => 'Onbekende persoon']);
    }
}
