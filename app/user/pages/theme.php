<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme Toggle</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/eb946b5c0a.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <div class="container mx-auto py-4">
        <div class="relative inline-block text-left">
            <button id="theme-toggle-button" class="inline-flex bg-white dark:bg-gray-800 justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200  dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg id="sun-icon" class="h-5 w-5 transition-all dark:-rotate-90 dark:scale-0 text-yellow-500 dark:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-8.66h1m-16 0h1M19.07 4.93l.71.71M4.22 19.78l.71.71M19.07 19.07l-.71.71M4.22 4.22l-.71.71M12 8a4 4 0 100 8 4 4 0 000-8z">
                    </path>
                </svg>
                <svg id="moon-icon" class="h-5 w-5 transition-all dark:rotate-0 dark:scale-100 text-gray-500 dark:text-gray-400 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                </svg>
                <span class="sr-only">Toggle theme</span>
            </button>
        </div>
    </div>

    <script>
        function setTheme(theme) {
            const html = document.documentElement;

            if (theme === 'light') {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else if (theme === 'dark') {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else if (theme === 'system') {
                localStorage.removeItem('theme');
                applySystemTheme();
            }

            updateIcons();
        }

        function updateIcons() {
            const html = document.documentElement;
            const sunIcon = document.getElementById('sun-icon');
            const moonIcon = document.getElementById('moon-icon');

            if (html.classList.contains('dark')) {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
                moonIcon.classList.add('scale-100');
                moonIcon.classList.remove('scale-0');
            } else {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
                sunIcon.classList.add('scale-100');
                sunIcon.classList.remove('scale-0');
            }
        }

        function applySystemTheme() {
            const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
            if (prefersDarkScheme.matches) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
            updateIcons();
        }

        function initializeTheme() {
            const storedTheme = localStorage.getItem('theme');
            if (storedTheme) {
                setTheme(storedTheme);
            } else {
                applySystemTheme();
            }
        }

        document.addEventListener('DOMContentLoaded', initializeTheme);

        document.getElementById('theme-toggle-button').addEventListener('click', function() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                setTheme('light');
            } else {
                setTheme('dark');
            }
        });
    </script>
</body>

</html>