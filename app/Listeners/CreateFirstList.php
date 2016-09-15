<?php

namespace App\Listeners;

use App\Events\UserWasRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\TodoList;

class CreateFirstList
{
    /**
     * Handle the event.
     *
     * @param  UserWasRegistered  $event
     * @return void
     */
    public function handle(UserWasRegistered $event)
    {
        $list = new TodoList();
        $list->name = 'My first list';
        $list->user_id = $event->user->id;
        $list->save();
    }
}
