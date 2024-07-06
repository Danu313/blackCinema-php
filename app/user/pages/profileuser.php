<div class="flex gap-4 ml-auto mx-auto items-center w-full">
    <div id="user-menu" class="relative">
        <button id="dropdownMenuButton" class="flex flex-row justify-center items-center gap-3 rounded-full px-2.5 border-2 border-gray-300 bg-gray-900 hover:bg-gray-800 duration-200 py-1.5">
            <i id="menu-icon" class="fas fa-bars w-5 h-5 self-center pt-0.5"></i>
            <img id="user-image" src="<?php echo $_SESSION['user_image']; ?>" alt="User Image" class="rounded-full bg-white w-7 h-7 object-cover">
        </button>
        <div id="dropdownMenu" class="hidden absolute bg-black right-0 mt-2 w-48 border border-gray-300 shadow-lg rounded-xl p-1 text-white bg-black animate-slide-down">
            <button id="profileButton" class="text-sm w-full p-2 rounded-lg text-left  hover:bg-gray-800 duration-200" type="button">
                <a href="pages/profile.php">Profile</a>
            </button>
            <button onclick="window.location.href = 'logout'" class="text-sm w-full p-2 rounded-lg text-left  hover:bg-gray-800 duration-200" type="button">
                Sign Out
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownButton = document.getElementById('dropdownMenuButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        dropdownButton.addEventListener('click', function(event) {
            if (event.target.closest('#menu-icon') || event.target.closest('#user-image') || event.target.closest('#dropdownMenuButton')) {
                dropdownMenu.classList.toggle('hidden');
            }
        });

        document.addEventListener('click', function(event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    });
</script>
