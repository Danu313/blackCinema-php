<div class="w-full text-gray-700 bg-white dark:text-gray-200 dark:bg-white/10">
    <div class="flex flex-row justify-between px-4 w-full md:flex-row md:items-center md:justify-between md:px-4">
        <div class="p-4 flex flex-row items-center justify-between">
            <a href="home.php" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">Black Cinema</a>
        </div>
        <button id="mobileMenuButton" class="md:hidden rounded-lg focus:outline-none focus:shadow-outline p-4">
            <svg class="h-6 w-6 text-gray-900 dark:text-white" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <nav id="mobileMenu" class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
            <a id="dashboardLink" class="nav-link px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="dashboard">
                Dashboard
            </a>
            <a id="moviesLink" class="nav-link px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="movies">
                Movies
            </a>
            <a id="advertisement" class="nav-link px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="advertisement">
                Iklan
            </a>
            <button id="paymentsLink" class="nav-link flex flex-row w-auto px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <span>Payments</span>
                <svg class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="paymentsDropdown" class="dropdown hidden absolute bg-white bg-opacity-90 top-[60px] right-20 rounded-lg text-gray-700 pt-1 w-auto z-50">
                <a class="block px-4 py-2 text-sm hover:bg-gray-100 duration-200" href="payment_list">History</a>
                <a class="block px-4 py-2 text-sm hover:bg-gray-100 duration-200" href="payment_plan">Paket</a>
                <a class="block px-4 py-2 text-sm hover:bg-gray-100 duration-200" href="payment_card">Metode Pembayaran</a>
                <a class="block px-4 py-2 text-sm hover:bg-gray-100 duration-200" href="payment_promo_code">Kode Promo</a>
            </div>
            <a id="usersLink" class="nav-link px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="users">
                Users
            </a>
        </nav>
    </div>

    <div id="mobileMenuItems" class="md:hidden hidden px-5">
        <div class="flex flex-col">
            <a id="dashboardLinkMobile" class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="dashboard">
                Dashboard
            </a>
            <a id="moviesLinkMobile" class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="movies">
                Movies
            </a>
            <button id="paymentsLinkMobile" class="flex justify-start px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                Payments
                <svg class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="mobilePaymentsDropdown" class="dropdown hidden pl-5 md:hidden w-auto z-50">
                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="payment_list">History</a>
                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="payment_plan">Paket</a>
                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="payment_card">Metode Pembayaran</a>
                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="payment_promo_code">Kode Promo</a>
            </div>
            <a id="usersLinkMobile" class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="users">
                Users
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var mobileMenuButton = document.getElementById('mobileMenuButton');
        var mobileMenuItems = document.getElementById('mobileMenuItems');
        var paymentsLink = document.getElementById('paymentsLink');
        var paymentsDropdown = document.getElementById('paymentsDropdown');
        var mobilePaymentsDropdown = document.getElementById('mobilePaymentsDropdown');

        mobileMenuButton.addEventListener('click', function() {
            mobileMenuItems.classList.toggle('hidden');
        });

        paymentsLink.addEventListener('click', function() {
            paymentsDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            if (!paymentsLink.contains(event.target)) {
                paymentsDropdown.classList.add('hidden');
            }
        });

        var paymentsLinkMobile = document.getElementById('paymentsLinkMobile');
        paymentsLinkMobile.addEventListener('click', function() {
            mobilePaymentsDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            if (!paymentsLinkMobile.contains(event.target)) {
                mobilePaymentsDropdown.classList.add('hidden');
            }
        });
    });
</script>