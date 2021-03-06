<?php

namespace App\Repositories\Product;

use App\Exceptions\Product\ProductAvailabilityException;
use App\Models\ProductOption;

class ProductAvailabilityRepository extends ProductAndOptionRepository
{
    public function save(ProductOption $productOption, ?string $email = null): void
    {
        if (($email && $productOption->availabilityNotifications()->where('email', $email)->exists())
            || (auth()->check() && $productOption->availabilityNotifications()->where('user_id', auth()->id())->exists())
        ) {
            throw new ProductAvailabilityException(
                "Vous êtes déjà mis sur la liste des personnes 
                qui seront averties lors de la prochaine disponibilité du vêtement"
                , 1
            );
        }

        $productOption->availabilityNotifications()->create([
            'user_id' => $email ? null : auth()->id(),
            'email' => $email,
        ]);
    }
}
