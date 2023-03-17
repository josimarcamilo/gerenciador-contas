<?php

namespace App\Listeners;

use App\Models\FinancialArea;
use Illuminate\Auth\Events\Registered;
use Ramsey\Uuid\Uuid;

class CreateFinancialArea
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;
        $model = new FinancialArea();
        $model->description = $user->name;
        $model->user_id = $user->id;
        $model->uuid = Uuid::uuid4();
        $model->save();
    }
}
