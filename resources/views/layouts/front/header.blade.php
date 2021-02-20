<header class="bg-primary-200 p-8">
    <section class="w-full h-full flex flex-wrap justify-between items-center">
        <a href="{{ route('welcome') }}" class="logo text-6xl font-cursive relative">
            <span
                class="w-32 h-2 bg-primary-500 bg-opacity-70 absolute top-11 left-12 transform -rotate-6 z-0"></span>
            <span class="relative z-10">Beehemiam</span>
        </a>

        <button type="button" class="responsive-button flex md:hidden p-4 focus:outline-none">
            <svg class="w-7 h-7 focus:outline-none" viewBox="0 0 24 24">
                <path fill="currentColor" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" />
            </svg>
        </button>

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

                <ul class="flex items-center space-x-4 md:space-x-2 mt-3 md:mt-0">
                    @if (auth()->check() && auth()->user()->is_admin)
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="relative flex p-2 transition-colors duration-200 rounded hover:bg-primary-400 hover:bg-opacity-25"
                                title="Administration">
                                <svg class="w-6 h-6" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M21.7 18.6V17.6L22.8 16.8C22.9 16.7 23 16.6 22.9 16.5L21.9 14.8C21.9 14.7 21.7 14.7 21.6 14.7L20.4 15.2C20.1 15 19.8 14.8 19.5 14.7L19.3 13.4C19.3 13.3 19.2 13.2 19.1 13.2H17.1C16.9 13.2 16.8 13.3 16.8 13.4L16.6 14.7C16.3 14.9 16.1 15 15.8 15.2L14.6 14.7C14.5 14.7 14.4 14.7 14.3 14.8L13.3 16.5C13.3 16.6 13.3 16.7 13.4 16.8L14.5 17.6V18.6L13.4 19.4C13.3 19.5 13.2 19.6 13.3 19.7L14.3 21.4C14.4 21.5 14.5 21.5 14.6 21.5L15.8 21C16 21.2 16.3 21.4 16.6 21.5L16.8 22.8C16.9 22.9 17 23 17.1 23H19.1C19.2 23 19.3 22.9 19.3 22.8L19.5 21.5C19.8 21.3 20 21.2 20.3 21L21.5 21.4C21.6 21.4 21.7 21.4 21.8 21.3L22.8 19.6C22.9 19.5 22.9 19.4 22.8 19.4L21.7 18.6M18 19.5C17.2 19.5 16.5 18.8 16.5 18S17.2 16.5 18 16.5 19.5 17.2 19.5 18 18.8 19.5 18 19.5M11.29 20H5C3.89 20 3 19.1 3 18V6C3 4.89 3.9 4 5 4H19C20.11 4 21 4.9 21 6V11.68C20.38 11.39 19.71 11.18 19 11.08V8H5V18H11C11 18.7 11.11 19.37 11.29 20Z" />
                                </svg>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="#"
                            class="relative flex p-2 transition-colors duration-200 rounded hover:bg-primary-400 hover:bg-opacity-25"
                            title="Rechercher">
                            <svg class="w-6 h-6" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        @auth
                            <a href="{{ route('user.profile.dashboard') }}" class="flex p-2 transition-colors duration-200 rounded hover:bg-primary-400 hover:bg-opacity-25"
                                title="Mon compte">
                                <svg class="w-6 h-6" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="flex p-2 transition-colors duration-200 rounded hover:bg-primary-400 hover:bg-opacity-25"
                                title="Me connecter">
                                <svg class="w-6 h-6" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" />
                                </svg>
                            </a>
                        @endauth
                    </li>
                    <li>
                        <a href="#"
                            class="relative flex p-2 transition-colors duration-200 rounded hover:bg-primary-400 hover:bg-opacity-25"
                            title="Mon panier">
                            <svg class="w-6 h-6" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M22 9H17.21L12.83 2.44C12.64 2.16 12.32 2 12 2S11.36 2.16 11.17 2.45L6.79 9H2C1.45 9 1 9.45 1 10C1 10.09 1 10.18 1.04 10.27L3.58 19.54C3.81 20.38 4.58 21 5.5 21H18.5C19.42 21 20.19 20.38 20.43 19.54L22.97 10.27L23 10C23 9.45 22.55 9 22 9M12 4.8L14.8 9H9.2L12 4.8M18.5 19L5.5 19L3.31 11H20.7L18.5 19M12 13C10.9 13 10 13.9 10 15S10.9 17 12 17 14 16.1 14 15 13.1 13 12 13Z" />
                            </svg>
                            {{-- <span
                                class="absolute -top-0.5 -right-0.5 bg-primary-600 text-white py-0.5 px-1 rounded-full text-xs">
                                2
                            </span> --}}
                        </a>
                    </li>
                    @auth
                        <li>
                            <x-form.form action="{{ route('logout') }}" method="POST">
                                <button type="submit"
                                    class="relative flex p-2 transition-colors duration-200 rounded hover:bg-primary-400 hover:bg-opacity-25"
                                    title="Me déconnecter">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M16,17V14H9V10H16V7L21,12L16,17M14,2A2,2 0 0,1 16,4V6H14V4H5V20H14V18H16V20A2,2 0 0,1 14,22H5A2,2 0 0,1 3,20V4A2,2 0 0,1 5,2H14Z" />
                                    </svg>
                                </button>
                            </x-form.form>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </section>
</header>