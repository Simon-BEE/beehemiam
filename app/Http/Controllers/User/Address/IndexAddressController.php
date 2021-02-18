<?php

namespace App\Http\Controllers\User\Address;

use App\Http\Controllers\Controller;

class IndexAddressController extends Controller
{
    public function __invoke()
    {
        return view('user.addresses.index', [
            'user' => auth()->user(),
            'addresses' => auth()->user()->addresses,
        ]);
    }
}
