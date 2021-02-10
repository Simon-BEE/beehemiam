<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin' }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <script src="{{ mix('js/back.js') }}" defer></script>
</head>

<body class="relative">
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('layouts.back.menu')
        @include('layouts.back.mobile-menu')

        <div class="flex flex-col flex-1 w-full">
            @include('layouts.back.navigation-dropdown')
            <main class="h-full overflow-y-auto">
                @yield('content')
            </main>
        </div>

        @if (session()->has('type'))
            <div class="fixed bottom-2 right-6 max-w-5xl p-4 shadow text-white bg-purple-600 rounded-lg shadow-xs">
                <button class="absolute top-1 right-1 text-xl font-bold px-2 py-1 rounded hover:bg-purple-500 focus:outline-none" onclick="this.parentNode.remove()">
                    &times;
                </button>
                <h4 class="mb-4 font-semibold">{{ session('type') }}</h4>
                <p>{{ session('message') }}</p>
            </div>
        @endif


        @stack('modals')

        @livewireScripts
    </div>

<script>
    function data() {
        function getThemeFromLocalStorage() {
            // if user already changed the theme, use it
            if (window.localStorage.getItem('dark')) {
                return JSON.parse(window.localStorage.getItem('dark'))
            }
        
            // else return their preferences
            return (
                !!window.matchMedia &&
                window.matchMedia('(prefers-color-scheme: dark)').matches
                )
        }
    
        function setThemeToLocalStorage(value) {
            window.localStorage.setItem('dark', value)
        }
    
        return {
            dark: getThemeFromLocalStorage(),
            toggleTheme() {
                this.dark = !this.dark
                setThemeToLocalStorage(this.dark)
            },
            isSideMenuOpen: false,
            toggleSideMenu() {
                this.isSideMenuOpen = !this.isSideMenuOpen
            },
            closeSideMenu() {
                this.isSideMenuOpen = false
            },
            isNotificationsMenuOpen: false,
            toggleNotificationsMenu() {
                this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
            },
            closeNotificationsMenu() {
                this.isNotificationsMenuOpen = false
            },
            isProfileMenuOpen: false,
            toggleProfileMenu() {
                this.isProfileMenuOpen = !this.isProfileMenuOpen
            },
            closeProfileMenu() {
                this.isProfileMenuOpen = false
            },
            isPagesMenuOpen: false,
            togglePagesMenu() {
                this.isPagesMenuOpen = !this.isPagesMenuOpen
            },
            // Modal
            isModalOpen: false,
            trapCleanup: null,
            openModal() {
                this.isModalOpen = true
                // this.trapCleanup = focusTrap(document.querySelector('#modal'))
            },
            closeModal() {
                this.isModalOpen = false
                this.trapCleanup()
            },
            changeModalButtonLink(link){
                document.querySelector('#modal').querySelector('form.delete-modal-form').action = link;
            }
        }
    }
</script>

@stack('scripts')
</body>

</html>
