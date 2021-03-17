<div class="alert-box relative p-6 pr-9 mb-4 rounded-lg shadow-xl z-40 transition-opacity duration-500 bg-primary-100 border border-b-8 border-primary-200 w-full">
    <button class="close-alert absolute top-1 right-1 text-2xl px-1 py-0.5 rounded hover:bg-gray-200 focus:outline-none">&times;</button>

    <p><strong class="{{ session('type') === 'Erreur' ? 'text-red-500' : 'text-green-400' }}">{{ session('type') }}.</strong> {{ session('message') }}</p>
</div>
