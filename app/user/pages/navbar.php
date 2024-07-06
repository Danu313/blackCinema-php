<nav class="absolute py-5 z-50 w-full h-fit inset-0 px-10" style="background-color: rgba(0, 0, 0, 0.3);">
    <div class="flex flex-wrap items-center justify-between mx-auto">
        <a href="home.php" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://res.cloudinary.com/dutlw7bko/image/upload/v1716618897/Cinema/Logo/Cuplikan_layar_2024-05-14_083355_jr8lu6_1_wc2vsh.png" class="h-12 rounded-lg" alt="Flowbite Logo" />
        </a>
        <div class="flex flex-row gap-2">
            <a href="about"><i class="fa-solid fa-info bg-gray-900 text-gray-300 border-2 border-gray-700 rounded-lg px-4 py-2 hover:bg-gray-800 duration-200"></i></a>
            <a href="favorites"><i class="fa-solid fa-bookmark bg-gray-900 text-gray-300 border-2 border-gray-700 rounded-lg px-4 py-2 hover:bg-gray-800 duration-200"></i></a>     
            <a href="notification"><i class="fa-solid fa-bell bg-gray-900 text-gray-300 border-2 border-gray-700 rounded-lg px-4 py-2 hover:bg-gray-800 duration-200"></i></a>     
            <a href="movie_cart"><i class="fa-solid fa-cart-shopping bg-gray-900 text-gray-300 border-2 border-gray-700 rounded-lg px-4 py-2 hover:bg-gray-800 duration-200"></i></a>     
        </div>
        <div class="items-center justify-between z-50 hidden w-full md:flex md:w-auto" id="navbar-menu">
            <ul class="flex flex-col items-center p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0" id="navbar-menu-list">
                <li>
                    <?php include("profileuser.php"); ?>
                </li>
            </ul>
        </div>
    </div>
</nav>