<div class="fixed bottom-2 right-6 max-w-5xl p-4 shadow text-white 
    {{ session('type') === 'Erreur' ? 'bg-red-500' : (session('type') === 'Attention' ? 'bg-primary-500' : 'bg-purple-600') }} 
    rounded-lg shadow-xs">
    <button 
        class="absolute top-1 right-1 text-xl font-bold px-2 py-1 rounded 
            {{ session('type') === 'Erreur' ? 'hover:bg-red-600' : (session('type') === 'Attention' ? 'hover:bg-primary-600' : 'hover:bg-purple-500') }} 
            focus:outline-none" onclick="this.parentNode.remove()"
    >
        &times;
    </button>
    <h4 class="mb-4 font-semibold">
        {{ session('type') }}
    </h4>
    <p>
        {{ session('message') }}
    </p>
</div>