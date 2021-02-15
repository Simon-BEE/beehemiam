<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;

class IndexUserController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.users.index', [
            'users' => User::whereRole('ROLE_USER')->orderBy('lastname')->paginate(16),
        ]);
    }
}
