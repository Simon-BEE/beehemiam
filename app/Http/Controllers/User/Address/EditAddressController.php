<?php

namespace App\Http\Controllers\User\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Address\EditAddressRequest;
use App\Models\Address;
use App\Models\Country;
use App\Repositories\Users\UserAddressRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EditAddressController extends Controller
{
    public function edit(Address $address): View
    {
        $this->authorize('update', $address);

        return view('user.addresses.edit', [
            'user' => auth()->user(),
            'address' => $address,
            'countries' => Country::all(),
        ]);
    }

    public function update(
        UserAddressRepository $repository,
        EditAddressRequest $request,
        Address $address
    ): RedirectResponse {
        try {
            $repository->update($address, $request->validated());

            return back()->with([
                'type' => 'Succès',
                'message' => 'Votre adresse a bien été modifiée.',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }

    public function setAsMain(UserAddressRepository $repository, Address $address): RedirectResponse
    {
        try {
            $repository->setAsMain($address);

            return redirect()->route('user.addresses.index')->with([
                'type' => 'Succès',
                'message' => 'Votre adresse a bien été définie comme principale.',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
