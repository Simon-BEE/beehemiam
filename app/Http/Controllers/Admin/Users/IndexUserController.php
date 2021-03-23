<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class IndexUserController extends Controller
{
    public function __invoke(): View
    {
        $users = User::whereRole('ROLE_USER');

        if (request()->get('name') || request()->get('email')) {
            $users = $this->filterUsers($users);
        }

        return view('admin.users.index', [
            'users' => $users->orderBy('lastname')->paginate(10),
        ]);
    }

    private function filterUsers(Builder|Model $users): Builder
    {
        $users
            ->when(request()->get('name'), function ($query) {
                $searchTerm = request()->get('name');

                return $query->where('firstname', 'LIKE',"%{$searchTerm}%")
                    ->orWhere('lastname', 'LIKE',"%{$searchTerm}%");
            })
            ->when(request()->get('name'), function ($query) {
                $searchTerm = request()->get('email');

                return $query->where('email', 'LIKE',"%{$searchTerm}%");
            });

        return $users;
    }
}
