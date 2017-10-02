<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * An eloquent database model: 'statusses'
 *
 * @property integer        $id             The primary key in the database from the status label.
 * @property integer        $author_id      The id form the user who created the status label.
 * @property string         $color          THe HEX color for the status label.
 * @property string         $name           The name for the status label.
 * @priopert string         $description    The discription from the status label.
 * @property \Carbon\Carbon $created_at     The timestamp when the status label has been created.
 * @property \Carbon\Carbon $updated_at     The timestamp when the status last updated.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\ActivismeBE\Statusses[] $author
 */
class Statusses extends Model
{
    // TODO: Write migration.
    // TODO: Build up testing factory.

    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'color', 'name', 'description'];

    /**
     * Data relation for the status label author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
