<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent databasemodel 'Comments'
 *
 * @property integer        $id         The unique identifier in the storage.
 * @property integer        $author_id  The user id form the author.
 * @property string         $message    The comment message.
 * @property \Carbon\Carbon $created_at The timestamp when the record has been created
 * @property \Carbon\Carbon $updated_at The timestamp when the record last has been updated.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\ActivismeBE\User[] $author.
 */
class Comments extends Model
{
    /**
     * Mass-assign fields for the mass-assign fields.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'message'];

    /**
     * Data relation for the comment author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
