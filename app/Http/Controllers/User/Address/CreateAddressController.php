<?php

namespace App\Http\Controllers\User\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Address\CreateAddressRequest;
use App\Models\Country;
use App\Repositories\Users\UserAddressRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CreateAddressController extends Controller
{
    public function create(): View
    {
        return view('user.addresses.create', [
            'user' => auth()->user(),
            'countries' => Country::all(),
        ]);
    }

    public function store(UserAddressRepository $repository, CreateAddressRequest $request): RedirectResponse
    {
        try {
            $repository->save(auth()->user(), $request->validated());

            return back()->with([
                'type' => 'Succès',
                'message' => 'Votre adresse a bien été créée.',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
