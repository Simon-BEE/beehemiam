<section class="px-4 py-3 mb-8 bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
    <h2 class="font-semibold text-xs uppercase text-gray-500">
        Résumé de l'activité
    </h2>

    <div class="flex flex-col lg:flex-row items-center justify-around text-center dark:text-gray-400">
        <article class="w-full lg:w-1/4 py-6">
            <h3 class="font-bold text-4xl">{{ $orders_count }}</h3>
            <h4 class="text-xl font-semibold"> commande{{ $orders_count > 1 ? 's' : '' }}</h4>
        </article>
        <article class="w-full lg:w-1/4 py-6 lg:border-l-2 lg:border-r-2">
            <h3 class="font-bold text-4xl">{{ $items_count }}</h3>
            <h4 class="text-xl font-semibold"> vêtement{{ $items_count > 1 ? 's' : '' }} acheté{{ $items_count > 1 ? 's' : '' }}</h4>
        </article>
        <article class="w-full lg:w-1/4 py-6">
            <h3 class="font-bold text-4xl">{{ $user->formatted_spent }}€</h3>
            <h4 class="text-xl font-semibold"> dépensé{{ $user->formatted_spent > 1 ? 's' : '' }}</h4>
        </article>
    </div>

    @if (request()->routeIs('admin.users.show'))
        <p class="text-right text-gray-500">
            <a href="{{ route('admin.users.orders', $user) }}" class="text-xs uppercase hover:underline">Voir plus...</a>
        </p>
    @endif

</section>
