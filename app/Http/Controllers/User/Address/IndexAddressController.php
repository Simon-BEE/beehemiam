<?php

namespace App\Http\Controllers\User\Address;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class IndexAddressController extends Controller
{
    public function __invoke(): View
    {
        return view('user.addresses.index', [
            'user' => auth()->user(),
            'addresses' => auth()->user()->addresses,
        ]);
    }
}
