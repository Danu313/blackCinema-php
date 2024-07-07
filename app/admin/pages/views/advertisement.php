<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Advertisement Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        /* Your custom CSS styles here */
    </style>
</head>
<body class="bg-white text-black dark:bg-black dark:text-white">
    <div class="container mx-auto py-6">
        <!-- Add Advertisement Form -->
        <div class="mb-4">
            <button id="addBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Advertisement
            </button>
        </div>

        <!-- Advertisement List -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700" id="advertisementList">
                        <?php
                        include "pages/controller/advertisement/advertisement_controller.php";
                        $advertisements = getAllAdvertisements();

                        if (is_array($advertisements) && !empty($advertisements)) {
                            foreach ($advertisements as $row) { ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $row['id']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="<?= $row['links']; ?>" alt="Advertisement Image" class="h-10 w-10 object-cover rounded-full">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded editBtn" data-id="<?= $row['id']; ?>">Edit</button>
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded deleteBtn" data-id="<?= $row['id']; ?>">Delete</button>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            // Handle case when no advertisements found
                            echo '<tr><td colspan="3" class="text-center py-4">No advertisements found.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Advertisement Modal -->
    <div id="addModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen p-6">
            <div class="relative bg-white dark:bg-gray-800 w-full max-w-lg mx-auto rounded-lg shadow-lg">
                <div class="flex items-start justify-between p-5 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Add Advertisement</h2>
                    <button id="closeAddModal" class="text-gray-500 dark:text-gray-400 hover:text-gray-400 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="addAdvertisementForm" class="p-5 space-y-4">
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image URL</label>
                        <input type="url" id="image" name="image" class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Advertisement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addModal = document.getElementById('addModal');
            const closeAddModalBtn = document.getElementById('closeAddModal');
            const addAdvertisementForm = document.getElementById('addAdvertisementForm');
            const advertisementList = document.getElementById('advertisementList');

            // Show add modal
            document.getElementById('addBtn').addEventListener('click', function() {
                addModal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            });

            // Close add modal
            closeAddModalBtn.addEventListener('click', function() {
                addModal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });

            // Handle add advertisement form submission
            addAdvertisementForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const image = document.getElementById('image').value;

                fetch('pages/controller/advertisement/advertisement_controller.php?action=add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            image: image
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Advertisement added successfully!',
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to add advertisement. Please try again.',
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to add advertisement. Please try again.',
                        });
                    });
            });

            // Handle delete advertisement
            advertisementList.addEventListener('click', function(event) {
                if (event.target.classList.contains('deleteBtn')) {
                    const advertisementId = event.target.getAttribute('data-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this advertisement!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`pages/controller/advertisement/advertisement_controller.php?action=delete&id=${advertisementId}`, {
                                    method: 'GET'
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Deleted!',
                                            text: 'Advertisement has been deleted.',
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Failed to delete advertisement. Please try again.',
                                        });
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Failed to delete advertisement. Please try again.',
                                    });
                                });
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
