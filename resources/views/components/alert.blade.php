<div class="alert-box fixed top-24 right-2 py-4 pl-4 pr-9 rounded-lg shadow-xl z-40 transition-opacity duration-500 bg-primary-100 border-t border-b-4 {{ session('type') === 'Erreur' ? 'border-red-300' : 'border-green-200' }} max-w-2xl">
    <button class="close-alert absolute top-1 right-1 text-2xl px-1 py-0.5 rounded hover:bg-gray-200 focus:outline-none">&times;</button>
    
    <p><strong class="{{ session('type') === 'Erreur' ? 'text-red-500' : 'text-green-200' }}">{{ session('type') }}.</strong> {{ session('message') }}</p>
</div>