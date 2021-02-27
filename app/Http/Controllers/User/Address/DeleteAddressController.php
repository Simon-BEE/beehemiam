<?php

namespace App\Http\Controllers\User\Address;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Repositories\Users\UserAddressRepository;
use Exception;
use Illuminate\Http\RedirectResponse;

class DeleteAddressController extends Controller
{
    public function __invoke(UserAddressRepository $repository, Address $address): RedirectResponse
    {
        $this->authorize('delete', $address);

        try {
            $repository->delete($address);

            return redirect()->route('user.addresses.index')->with([
                'type' => 'Succès',
                'message' => 'Votre adresse a bien été supprimée.',
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
