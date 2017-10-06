<?php

namespace ActivismeBE\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\View\View;

/**
 * Class NotificationsController
 *
 * @author  Tim Joosten
 * @license MIT License
 * @package ActivismeBE\Http\Controllers
 */
class NotificationsController extends Controller
{
    private $databaseNotification; /** DatabaseNotification $databaseNotification */

    /**
     * NotificationsController constructor.
     *
     * @param  DatabaseNotification $databaseNotification The database model for the notifications.
     * @return void
     */
    public function __construct(DatabaseNotification $databaseNotification)
    {
        $this->middleware('auth');
        $this->middleware('role:admin|supervisor');
        $this->middleware('forbid-banned-user');

        $this->databaseNotification = $databaseNotification;
    }

    /**
     * Get the index view for the notifications view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(): View
    {
        $userNotifications = auth()->user()->notifications();

        return view('notifications.index', [
            'notifications' => $userNotifications->where('read_at', '')->paginate(10),
            'unreads'       => $userNotifications->paginate(10)
        ]);
    }

    /**
     * Mark a specific notification as read.
     *
     * @param  string $notificationid The serialization id in the storage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsRead($notificationid)
    {
        $notification = auth()->user()->notifications()->findOrFail($notificationid) ?: abort(404);
        $notification->markAsread();

        return redirect()->route($notification->data['route']);
    }

    /**
     * Mark the user his notifications as read.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAllAsRead(): RedirectResponse
    {
       auth()->user()->unreadNotifications->markAsRead();
       return redirect()->back(302);
    }
}
