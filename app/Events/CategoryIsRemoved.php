<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CategoryIsRemoved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
}
