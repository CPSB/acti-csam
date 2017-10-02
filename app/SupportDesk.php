<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent database model 'SupportDesk'
 * 
 * @property integer        $id             The primary key in the database table. 
 * @property integer        $author_id      The user id from the author who created the support ticket. 
 * @property integer        $assignee_id    The user id form who is assigned to the ticket. 
 * @property integer        $category_id    The id from the ticket category
 * @property string         $subject        The subject from the support ticket.
 * @property string         $description    The description from the support ticket.
 * @property \Carbon\Carbon $created_at     The ticket when the ticket has been created.
 * @property \Carbon\Carbon $updated_at     The timestamp when the ticket last when updated.
 * 
 * @property-read //* Document author relation 
 * @property-read //* Document assignee relation
 * @property-read //* Document category Relation
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
    protected $fillable = ['author_id', 'assignee_id', 'category_id', 'subject', 'description'];

    /**
     * @todo: docblock
     */
    public function author() 
    {
        // TODO: Build up database relation
    }

    /**
     * @todo docblock
     */
    public function assignee() 
    {
        //? ->withDefault(); nodig omdat bij de creatie soms geen assignee word meegegeven. 
        // TODO: Build up database relation
    }

    /**
     * @todo docblock
     */
    public function category() 
    {
        //? ->withdefault(); nodig omdat bij de creatie soms geen category word meegegeven.
        // TODO: Build up database relation.
    }
}
