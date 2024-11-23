<x-layout>
    <x-slot:title>Chat - Bertani.com</x-slot:title>
    <!-- component -->
    <div class="flex h-screen overflow-hidden m-4">
        <!-- Sidebar -->
        <div class="w-1/4 bg-white border-r border-gray-300 hidden lg:block">
            <!-- Sidebar Header -->
            <header class="p-4 border-b border-gray-300 flex justify-between items-center bg-indigo-600 text-white">
                <h1 class="text-2xl font-semibold">Chat Web</h1>
                <div class="relative">
                    <button id="menuButton" class="focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-100" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path d="M2 10a2 2 0 012-2h12a2 2 0 012 2 2 2 0 01-2 2H4a2 2 0 01-2-2z" />
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Contact List -->
            <div class="overflow-y-auto h-screen p-3 mb-9 pb-20">
                <!-- Loop through contacts here -->
                <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
                    <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                        <img src="https://placehold.co/200x/ffa8e4/ffffff.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar"
                            class="w-12 h-12 rounded-full">
                    </div>
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold">Alice</h2>
                        <p class="text-gray-600">Hoorayy!!</p>
                    </div>
                </div>
                <!-- More contact items here -->
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="flex-1 flex flex-col">
            <!-- Chat Header -->
            <header class="bg-white p-4 text-gray-700 border-b border-gray-300">
                <h1 class="text-2xl font-semibold">Alice</h1>
            </header>

            <!-- Chat Messages -->
            <div class="flex-1 overflow-y-auto p-4 pb-36">
                <!-- Incoming Message -->
                <div class="flex mb-4 cursor-pointer">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center mr-2">
                        <img src="https://placehold.co/200x/ffa8e4/ffffff.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato"
                            alt="User Avatar" class="w-8 h-8 rounded-full">
                    </div>
                    <div class="flex max-w-96 bg-gray-300 rounded-lg p-3 gap-3">
                        <p class="text-gray-700">Hey Bob, how's it going?</p>
                    </div>
                </div>
                <!-- More chat items here -->
            </div>

            <!-- Chat Input -->
            <footer class="bg-white border-t border-gray-300 p-4 flex items-center justify-between w-full">
                <input type="text" placeholder="Type a message..."
                    class="w-full p-2 rounded-md border border-gray-400 focus:outline-none focus:border-blue-500">
                <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2">Send</button>
            </footer>
        </div>
    </div>

    <script>
        // JavaScript for showing/hiding the menu
        const menuButton = document.getElementById('menuButton');
        const menuDropdown = document.getElementById('menuDropdown');

        menuButton.addEventListener('click', () => {
            menuDropdown.classList.toggle('hidden');
        });

        // Close the menu if you click outside of it
        document.addEventListener('click', (e) => {
            if (!menuDropdown.contains(e.target) && !menuButton.contains(e.target)) {
                menuDropdown.classList.add('hidden');
            }
        });
    </script>
</x-layout>
