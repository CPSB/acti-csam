<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent database model 'Priorities'
 *
 * @property integer            $id             The primary key in the storage form the priority.
 * @property integer            $author_id      he user id form the priority author.
 * @property string             $color          The HEX color value from the priority
 * @property string             $name           The label name for the priority
 * @property string             $description    The short description form the priority
 * @property \Carbon\Carbon     $created_at     The timestamp when the priority has been created
 * @property \Carbon\Carbon     $updated_at     The timestamp whe the priority was last updated.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\ActivismeBE\User[] $user
 */
class Priorities extends Model
{
    // TODO: Build up the migration.
    // TODO: Build up testing factory.

    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'color', 'name', 'description'];

    /**
     * Data relation for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
