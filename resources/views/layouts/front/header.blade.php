<header class="bg-primary-200 p-8">
    <section class="w-full h-full flex flex-wrap justify-between items-center">
        <a href="{{ route('welcome') }}" class="logo text-5xl sm:text-6xl font-cursive relative">
            <span
                class="w-32 h-2 bg-primary-500 bg-opacity-70 absolute top-8 sm:top-11 left-12 transform -rotate-6 z-0"></span>
            <span class="relative z-10">Beehemiam</span>
        </a>

        {{-- <button type="button" class="responsive-button flex md:hidden p-4 focus:outline-none">
            <svg class="w-7 h-7 focus:outline-none" viewBox="0 0 24 24">
                <path fill="currentColor" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" />
            </svg>
        </button> --}}
        <responsive-button></responsive-button>

        <nav class="responsive-menu hidden md:flex items-center space-x-6 w-full md:w-auto">

            <div class="flex flex-col md:flex-row mt-4 w-full md:space-x-6">
                <ul class="flex flex-col md:flex-row md:space-x-4 w-full">
                    <li>
                        <a href="{{ route('welcome') }}" class="nav-link relative flex p-2 rounded font-semibold">
                            Accueil
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link relative flex p-2 rounded font-semibold">
                            Découvrir la marque
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shop.categories.index') }}" class="nav-link relative flex p-2 rounded font-semibold">
                            La boutique
                        </a>
                    </li>
                </ul>

                <ul class="relative flex flex-col md:flex-row md:items-center flex-wrap md:flex-nowrap md:space-x-1 mt-2 md:mt-0">
                    <li>
                        <a href="#"
                            class="relative flex px-3 py-2 transition-colors duration-200 rounded hover:bg-primary-400 hover:bg-opacity-25"
                            title="Rechercher">
                            <svg class="w-6 h-6 mr-3 md:mr-0" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                            </svg>
                            <span class="md:hidden">Rechercher</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cart.index') }}"
                            class="relative flex px-3 py-2 transition-colors duration-200 rounded hover:bg-primary-400 hover:bg-opacity-25"
                            title="Mon panier">
                            <cart-icon></cart-icon>
                        </a>
                    </li>
                    <li class="w-full">
                        @auth
                            <auth-button title="Mon compte"></auth-button>
                            <ul class="popover-menu w-full md:absolute top-12 right-0 md:bg-primary-100 md:shadow-lg md:rounded-lg md:w-72 py-1 transition-opacity duration-100 md:opacity-0 -z-1">
                                @if (auth()->check() && auth()->user()->is_admin)
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="flex items-center px-3 py-2 transition-colors duration-300 hover:bg-primary-300"
                                            title="Administration">
                                            <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M21.7 18.6V17.6L22.8 16.8C22.9 16.7 23 16.6 22.9 16.5L21.9 14.8C21.9 14.7 21.7 14.7 21.6 14.7L20.4 15.2C20.1 15 19.8 14.8 19.5 14.7L19.3 13.4C19.3 13.3 19.2 13.2 19.1 13.2H17.1C16.9 13.2 16.8 13.3 16.8 13.4L16.6 14.7C16.3 14.9 16.1 15 15.8 15.2L14.6 14.7C14.5 14.7 14.4 14.7 14.3 14.8L13.3 16.5C13.3 16.6 13.3 16.7 13.4 16.8L14.5 17.6V18.6L13.4 19.4C13.3 19.5 13.2 19.6 13.3 19.7L14.3 21.4C14.4 21.5 14.5 21.5 14.6 21.5L15.8 21C16 21.2 16.3 21.4 16.6 21.5L16.8 22.8C16.9 22.9 17 23 17.1 23H19.1C19.2 23 19.3 22.9 19.3 22.8L19.5 21.5C19.8 21.3 20 21.2 20.3 21L21.5 21.4C21.6 21.4 21.7 21.4 21.8 21.3L22.8 19.6C22.9 19.5 22.9 19.4 22.8 19.4L21.7 18.6M18 19.5C17.2 19.5 16.5 18.8 16.5 18S17.2 16.5 18 16.5 19.5 17.2 19.5 18 18.8 19.5 18 19.5M11.29 20H5C3.89 20 3 19.1 3 18V6C3 4.89 3.9 4 5 4H19C20.11 4 21 4.9 21 6V11.68C20.38 11.39 19.71 11.18 19 11.08V8H5V18H11C11 18.7 11.11 19.37 11.29 20Z" />
                                            </svg>
                                            Administration
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('user.profile.dashboard') }}" class="flex items-center px-3 py-2 transition-colors duration-300 hover:bg-primary-300">
                                        <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M10 4A4 4 0 0 0 6 8A4 4 0 0 0 10 12A4 4 0 0 0 14 8A4 4 0 0 0 10 4M17 12C16.87 12 16.76 12.09 16.74 12.21L16.55 13.53C16.25 13.66 15.96 13.82 15.7 14L14.46 13.5C14.35 13.5 14.22 13.5 14.15 13.63L13.15 15.36C13.09 15.47 13.11 15.6 13.21 15.68L14.27 16.5C14.25 16.67 14.24 16.83 14.24 17C14.24 17.17 14.25 17.33 14.27 17.5L13.21 18.32C13.12 18.4 13.09 18.53 13.15 18.64L14.15 20.37C14.21 20.5 14.34 20.5 14.46 20.5L15.7 20C15.96 20.18 16.24 20.35 16.55 20.47L16.74 21.79C16.76 21.91 16.86 22 17 22H19C19.11 22 19.22 21.91 19.24 21.79L19.43 20.47C19.73 20.34 20 20.18 20.27 20L21.5 20.5C21.63 20.5 21.76 20.5 21.83 20.37L22.83 18.64C22.89 18.53 22.86 18.4 22.77 18.32L21.7 17.5C21.72 17.33 21.74 17.17 21.74 17C21.74 16.83 21.73 16.67 21.7 16.5L22.76 15.68C22.85 15.6 22.88 15.47 22.82 15.36L21.82 13.63C21.76 13.5 21.63 13.5 21.5 13.5L20.27 14C20 13.82 19.73 13.65 19.42 13.53L19.23 12.21C19.22 12.09 19.11 12 19 12H17M10 14C5.58 14 2 15.79 2 18V20H11.68A7 7 0 0 1 11 17A7 7 0 0 1 11.64 14.09C11.11 14.03 10.56 14 10 14M18 15.5C18.83 15.5 19.5 16.17 19.5 17C19.5 17.83 18.83 18.5 18 18.5C17.16 18.5 16.5 17.83 16.5 17C16.5 16.17 17.17 15.5 18 15.5Z" />
                                        </svg>
                                        Mon compte
                                    </a>
                                </li>
                                <li>
                                    <x-form.form action="{{ route('logout') }}" method="POST">
                                        <button type="submit"
                                            class="flex w-full items-center px-3 py-2 text-red-400 transition-colors duration-300 hover:bg-primary-300"
                                            title="Me déconnecter">
                                            <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M16,17V14H9V10H16V7L21,12L16,17M14,2A2,2 0 0,1 16,4V6H14V4H5V20H14V18H16V20A2,2 0 0,1 14,22H5A2,2 0 0,1 3,20V4A2,2 0 0,1 5,2H14Z" />
                                            </svg>
                                            Me déconnecter
                                        </button>
                                    </x-form.form>
                                </li>
                            </ul>
                        @else
                            <auth-button title="Me connecter"></auth-button>
                            <ul class="popover-menu w-full md:absolute top-12 right-0 md:bg-primary-100 md:shadow-lg md:rounded-lg md:w-72 py-1 transition-opacity duration-100 md:opacity-0 -z-1">
                                <li>
                                    <a href="{{ route('login') }}" class="flex items-center px-3 py-2 transition-colors duration-300 hover:bg-primary-300">
                                        <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M10,17V14H3V10H10V7L15,12L10,17M10,2H19A2,2 0 0,1 21,4V20A2,2 0 0,1 19,22H10A2,2 0 0,1 8,20V18H10V20H19V4H10V6H8V4A2,2 0 0,1 10,2Z" />
                                        </svg>
                                        Me connecter
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}" class="flex items-center px-3 py-2 transition-colors duration-300 hover:bg-primary-300">
                                        <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M8,12H16V14H8V12M10,20H6V4H13V9H18V12.1L20,10.1V8L14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H10V20M8,18H12.1L13,17.1V16H8V18M20.2,13C20.3,13 20.5,13.1 20.6,13.2L21.9,14.5C22.1,14.7 22.1,15.1 21.9,15.3L20.9,16.3L18.8,14.2L19.8,13.2C19.9,13.1 20,13 20.2,13M20.2,16.9L14.1,23H12V20.9L18.1,14.8L20.2,16.9Z" />
                                        </svg>
                                        Créer un compte
                                    </a>
                                </li>
                            </ul>
                        @endauth
                    </li>
                </ul>
            </div>
        </nav>
    </section>
</header>