<section class="flex flex-col md:flex-row items-start">
    <aside class="w-full md:w-1/4 bg-primary-300 pt-5 px-5 pb-6 md:pb-32">
        <ul class="flex flex-col space-y-1">
            <li>
                <a href="{{ route('user.profile.dashboard') }}" class="flex items-center px-2 py-3 transition-colors duration-300 font-semibold rounded-sm {{ request()->routeIs('user.profile.dashboard') ? 'bg-primary-700' : '' }} hover:bg-primary-700">
                    <svg class="w-5 h-5 mr-4" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M21,16V4H3V16H21M21,2A2,2 0 0,1 23,4V16A2,2 0 0,1 21,18H14V20H16V22H8V20H10V18H3C1.89,18 1,17.1 1,16V4C1,2.89 1.89,2 3,2H21M5,6H14V11H5V6M15,6H19V8H15V6M19,9V14H15V9H19M5,12H9V14H5V12M10,12H14V14H10V12Z" />
                    </svg>
                    Tableau de bord
                </a>
            </li>
            <li>
                <a href="{{ route('user.profile.edit') }}" class="flex items-center px-2 py-3 transition-colors duration-300 font-semibold rounded-sm {{ request()->routeIs('user.profile.edit') ? 'bg-primary-700' : '' }} hover:bg-primary-700">
                    <svg class="w-5 h-5 mr-4" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M22,3H2C0.91,3.04 0.04,3.91 0,5V19C0.04,20.09 0.91,20.96 2,21H22C23.09,20.96 23.96,20.09 24,19V5C23.96,3.91 23.09,3.04 22,3M22,19H2V5H22V19M14,17V15.75C14,14.09 10.66,13.25 9,13.25C7.34,13.25 4,14.09 4,15.75V17H14M9,7A2.5,2.5 0 0,0 6.5,9.5A2.5,2.5 0 0,0 9,12A2.5,2.5 0 0,0 11.5,9.5A2.5,2.5 0 0,0 9,7M14,7V8H20V7H14M14,9V10H20V9H14M14,11V12H18V11H14" />
                    </svg>
                    Mes informations personnelles
                </a>
            </li>
            <li>
                <a href="{{ route('user.profile.edit.password') }}" class="flex items-center px-2 py-3 transition-colors duration-300 font-semibold rounded-sm {{ request()->routeIs('user.profile.password') ? 'bg-primary-700' : '' }} hover:bg-primary-700">
                    <svg class="w-5 h-5 mr-4" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M12,3.18L19,6.3V11.22C19,12.92 18.5,14.65 17.65,16.17C16,14.94 13.26,14.5 12,14.5C10.74,14.5 8,14.94 6.35,16.17C5.5,14.65 5,12.92 5,11.22V6.3L12,3.18M12,6A3.5,3.5 0 0,0 8.5,9.5A3.5,3.5 0 0,0 12,13A3.5,3.5 0 0,0 15.5,9.5A3.5,3.5 0 0,0 12,6M12,8A1.5,1.5 0 0,1 13.5,9.5A1.5,1.5 0 0,1 12,11A1.5,1.5 0 0,1 10.5,9.5A1.5,1.5 0 0,1 12,8M12,16.5C13.57,16.5 15.64,17.11 16.53,17.84C15.29,19.38 13.7,20.55 12,21C10.3,20.55 8.71,19.38 7.47,17.84C8.37,17.11 10.43,16.5 12,16.5Z" />
                    </svg>
                    Modifier mon mot de passe
                </a>
            </li>
            <li>
                <a href="{{ route('user.addresses.index') }}" class="flex items-center px-2 py-3 transition-colors duration-300 font-semibold rounded-sm {{ request()->routeIs('user.addresses.*') ? 'bg-primary-700' : '' }} hover:bg-primary-700">
                    <svg class="w-5 h-5 mr-4" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,3L2,12H5V20H19V12H22L12,3M12,7.7C14.1,7.7 15.8,9.4 15.8,11.5C15.8,14.5 12,18 12,18C12,18 8.2,14.5 8.2,11.5C8.2,9.4 9.9,7.7 12,7.7M12,10A1.5,1.5 0 0,0 10.5,11.5A1.5,1.5 0 0,0 12,13A1.5,1.5 0 0,0 13.5,11.5A1.5,1.5 0 0,0 12,10Z" />
                    </svg>
                    Mes adresses
                </a>
            </li>
            <li>
                <a href="{{ route('user.orders.index') }}" class="flex items-center px-2 py-3 transition-colors duration-300 font-semibold rounded-sm {{ request()->routeIs('user.orders.*') ? 'bg-primary-700' : '' }} hover:bg-primary-700">
                    <svg class="w-5 h-5 mr-4" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M20 21H4V10H6V19H18V10H20V21M3 3H21V9H3V3M9.5 11H14.5C14.78 11 15 11.22 15 11.5V13H9V11.5C9 11.22 9.22 11 9.5 11M5 5V7H19V5H5Z" />
                    </svg>
                    Mon historique de commandes
                </a>
            </li>
            <li>
                <a href="{{ route('user.settings.index') }}" class="flex items-center px-2 py-3 transition-colors duration-300 font-semibold rounded-sm {{ request()->routeIs('user.settings.*') ? 'bg-primary-700' : '' }} hover:bg-primary-700">
                    <svg class="w-5 h-5 mr-4" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M13.78 15.3L19.78 21.3L21.89 19.14L15.89 13.14L13.78 15.3M17.5 10.1C17.11 10.1 16.69 10.05 16.36 9.91L4.97 21.25L2.86 19.14L10.27 11.74L8.5 9.96L7.78 10.66L6.33 9.25V12.11L5.63 12.81L2.11 9.25L2.81 8.55H5.62L4.22 7.14L7.78 3.58C8.95 2.41 10.83 2.41 12 3.58L9.89 5.74L11.3 7.14L10.59 7.85L12.38 9.63L14.2 7.75C14.06 7.42 14 7 14 6.63C14 4.66 15.56 3.11 17.5 3.11C18.09 3.11 18.61 3.25 19.08 3.53L16.41 6.2L17.91 7.7L20.58 5.03C20.86 5.5 21 6 21 6.63C21 8.55 19.45 10.1 17.5 10.1Z" />
                    </svg>
                    Paramètres
                </a>
            </li>

        </ul>
    </aside>

    <div class="w-full md:w-3/4 p-5 md:pl-8">
        {{ $slot }}
    </div>
</section>
