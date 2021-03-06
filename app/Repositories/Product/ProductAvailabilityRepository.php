<?php

namespace App\Repositories\Product;

use App\Models\ProductOption;

class ProductAvailabilityRepository extends ProductAndOptionRepository
{
    public function save(ProductOption $productOption, ?string $email = null): void
    {
        $productOption->availabilityNotifications()->create([
            'user_id' => $email ? null : auth()->id(),
            'email' => $email,
        ]);
    }
}
