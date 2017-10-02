<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent database model 'SupportDesk'
 * 
 * @property integer        $id             The primary key in the database table. 
 * @property integer        $author_id      The user id from the author who created the support ticket. 
 * @property integer        $assignee_id    The user id form who is assigned to the ticket. 
 * @property integer        $category_id    The id from the ticket category.
 * @property integer        $status_id      The status is from the support ticket.
 * @property string         $subject        The subject from the support ticket.
 * @property string         $description    The description from the support ticket.
 * @property \Carbon\Carbon $created_at     The ticket when the ticket has been created.
 * @property \Carbon\Carbon $updated_at     The timestamp when the ticket last when updated.
 * 
 * @property-read \Illuminate\Database\Eloquent\Collection|\ActivismeBE\User[]          $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\ActivismeBE\User[]          $assignee
 * @property-read \Illuminate\Database\Eloquent\Collection|\ActivismeBE\Categories[]    $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\ActivismeBE\Statusses[]     $status
 */
class SupportDesk extends Model
{
    //! NOTE: Consider soft deletes for the tickets
    //!       A ticket can be deleted. But need to be soft deleted. Because an admin sometimes want to undo a ticket.   

    // TODO: Build up the database migration. 

    /**
     * Mass-assign fields for the database table. 
     * 
     * @return array
     */
    protected $fillable = ['author_id', 'status_id', 'assignee_id', 'category_id', 'subject', 'description'];

    /**
     * Data relation for the support ticket author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author() 
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Data relation for the assignee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignee() 
    {
        return $this->belongsTo(User::class, 'assignee_id')
            ->withDefault(['name' => 'Niemand']);
    }

    /**
     * Data relation for the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() 
    {
        return $this->belongsTo(Categories::class, 'category_id')
            ->withDefault(['name' => 'Geen']);
    }

    /**
     * Data relation for the support ticket status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Statusses::class, 'status_id');
    }
}
