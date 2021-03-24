<section class="px-2 md:px-0">
    <div class="title pb-3 border-b flex flex-col md:flex-row items-start justify-between">
        <div class="">
            <h2 class="font-bold text-2xl">Commande n°{{ $order->id }}</h2>
            <p class="text-sm">Ma commande passée le {{ $order->created_at->format('d/m/Y') }}</p>
        </div>
        @if ($order->invoice)
            <a href="{{ auth()->check() ? route('user.orders.invoice', $order) : route('guest.orders.invoice', $order->hashed_id) }}" target="_blank" rel="noopener" class="rounded p-2 transition-colors duration-200 inline-flex items-center justify-center bg-primary-500 text-white  hover:bg-primary-400 font-semibold">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M14,2H6C4.89,2 4,2.89 4,4V20C4,21.11 4.89,22 6,22H18C19.11,22 20,21.11 20,20V8L14,2M12,19L8,15H10.5V12H13.5V15H16L12,19M13,9V3.5L18.5,9H13Z" />
                </svg>
                Télécharger la facture
                <svg class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M14,3V5H17.59L7.76,14.83L9.17,16.24L19,6.41V10H21V3M19,19H5V5H12V3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V12H19V19Z" />
                </svg>
            </a>
        @endif
    </div>

    <section class="my-6">
        <x-info>
            <p>{{ $order->verbose_status }} </p>
            @if ($order->has_preorder && $order->is_in_progress)
                <p>&nbsp; Elle sera expédiée lorsque la précommande sera terminée.</p>
            @endif
        </x-info>
    </section>

    <section class="my-6">
        <p>Vous avez passé commande le <strong>{{ $order->created_at->format('d/m/Y à H:i') }}</strong> pour un montant total TTC de <strong>{{ $order->formatted_price }}€</strong> contenant <strong>{{ $order->orderItems->count() < 2 ? '1 article' : $order->orderItems->count() . ' articles' }}</strong>.</p>
    </section>

    <section class="w-full flex flex-col md:flex-row items-start justify-between md:space-x-5 overflow-x-scroll md:overflow-x-auto">
        <article class="w-full md:w-1/3">
            <img src="https://source.unsplash.com/300x300/daily?clothing" alt="commande n°{{ $order->id }}" class="w-full object-cover">
        </article>

        <table class="w-full md:w-2/3 text-center whitespace-nowrap md:whitespace-normal">
            <thead>
                <tr class="bg-primary-200">
                    <th class="px-2 py-3 font-bold">Nom du vêtement</th>
                    <th class="px-2 py-3 font-bold">Quantité</th>
                    <th class="px-2 py-3 font-bold">Prix Unitaire</th>
                    <th class="px-2 py-3 font-bold">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr class="{{ $loop->even ? 'bg-primary-200' : '' }} hover:bg-primary-300">
                        <td class="px-2 py-3">
                            @if ($item->productOption)
                                <a href="{{ $item->productOption->path }}" class="hover:underline">
                                    {{ $item->name }}
                                    <span class="text-xs">(Taille {{ $item->size->name }})</span>
                                    <span class="text-xs">{{ $item->is_preorder ? ' précommande' : '' }}</span>
                                </a>
                            @else
                                {{ $item->name }}
                                <span class="text-xs">(Taille {{ $item->size->name }})</span>
                                <span class="text-xs">{{ $item->is_preorder ? ' précommande' : '' }}</span>
                            @endif
                        </td>
                        <td class="px-2 py-3">{{ $item->quantity }}</td>
                        <td class="px-2 py-3">{{ $item->formatted_price }}€</td>
                        <td class="px-2 py-3">{{ $item->formatted_price * $item->quantity }}€</td>
                    </tr>
                @endforeach
                @if ($order->coupons->isNotEmpty())
                    @foreach ($order->coupons as $coupon)
                        <tr class="">
                            <td colspan="2" class="p-2 hidden md:table-cell"></td>
                            <td class="p-2 border-b border-primary-300 font-bold bg-primary-300">Réduction <span class="text-xs">({{ $coupon->code }})</span></td>
                            <td class="p-2 border-b border-primary-300 font-bold bg-primary-300">-{{ $coupon->amount }}€</td>
                        </tr>
                    @endforeach
                @endif
                <tr class="">
                    <td colspan="2" class="p-2 hidden md:table-cell"></td>
                    <td class="p-2 border-b border-primary-300 font-bold">Montant total HT</td>
                    <td class="p-2 border-b border-primary-300 font-bold">{{ $order->formatted_price_without_taxes }}€</td>
                </tr>
                <tr class="">
                    <td colspan="2" class="p-2 hidden md:table-cell"></td>
                    <td class="p-2 border-b border-primary-300 font-bold">Frais de port TTC</td>
                    <td class="p-2 border-b border-primary-300 font-bold">{{ $order->formatted_shipping_fees }}€</td>
                </tr>
                <tr class="">
                    <td colspan="2" class="p-2 hidden md:table-cell"></td>
                    <td class="p-2 border-b border-primary-300 font-bold bg-primary-300">Montant total TTC</td>
                    <td class="p-2 border-b border-primary-300 font-bold bg-primary-300">{{ $order->formatted_price }}€</td>
                </tr>
            </tbody>
        </table>
    </section>

    @if ($order->payment)
        <section class="mt-8 p-4 bg-primary-200 rounded">
            <p>Le paiement de la commande a été réalisé par <strong>{{ $order->payment->type == 'card' ? "Carte bancaire" : "Paypal" }}</strong></p>
        </section>
    @endif

    @if ($order->address && $order->invoice)
        <section class="mt-8 p-4 rounded bg-primary-300">
            <h3 class="font-bold mb-4">La commande sera livrée à l'adresse suivante :</h3>
            <p>{{ $order->address->full_name }}</p>
            <p>{{ $order->address->street }} {{ $order->address->additionnal }}, {{ $order->address->city }} {{ $order->address->zipcode }}, {{ $order->address->country->name }}</p>
            <p class="text-xs font-semibold">{{ $order->email_contact }} {{ $order->address->phone }}</p>

            <p class="my-4">La livraison est assurée par le service <strong>{{ ucfirst($order->shipping->name) }}</strong>.</p>

            @if (!$order->is_shipped && $order->is_in_progress)
                <p class="text-sm mt-3">Si vous constatez une erreur, vous pouvez nous contacter à l'adresse suivante <a href="mailto:contact@beehemiam.fr" class="text-primary-500 hover:underline">contact@beehemiam.fr</a> ou depuis la partie <a href="{{ route('contact.index') }}" class="text-primary-500 hover:underline">contact</a> du site, en précisant le motif et la référence de la commande.</p>
            @endif
        </section>
    @endif
