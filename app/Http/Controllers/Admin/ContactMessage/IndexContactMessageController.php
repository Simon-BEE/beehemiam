<?php

namespace App\Http\Controllers\Admin\ContactMessage;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class IndexContactMessageController extends Controller
{
    public function __invoke(): View
    {
        $messages = ContactMessage::query();

        if (request()->get('email') || request()->get('object') || request()->get('read') ) {
            $messages = $this->filterMessages($messages);
        }

        return view('admin.messages.index', [
            'messages' => $messages->latest()->paginate(10),
        ]);
    }

    private function filterMessages(Builder|Model $messages): Builder|Model
    {
        $messages
            ->when(request()->get('email'), function ($query) {
                $searchTerm = request()->get('email');

                return $query->where('email', 'LIKE', "%{$searchTerm}%");
            })
            ->when(request()->get('object'), function ($query) {
                $searchTerm = request()->get('object');

                return $query->where('object', 'LIKE', "%{$searchTerm}%");
            })
            ->when(request()->get('read') === 'read', function ($query) {
                return $query->whereNotNull('read_at');
            })
            ->when(request()->get('read') === 'unread', function ($query) {
                return $query->whereNull('read_at');
            });

        return $messages;
    }
}
