<header class="glass-effect bg-white/80 shadow-sm">
    <div
        class="container mx-auto px-4 py-3 flex justify-between items-center"
    >
        <div class="flex items-center space-x-3">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent"
            >
                POS
            </h1>
        </div>
        <div class="flex items-center space-x-4">
            <div
                class="hidden md:flex items-center space-x-2 bg-indigo-50 px-3 py-1 rounded-full"
            >
                <div
                    class="w-2 h-2 rounded-full bg-green-500 animate-pulse"
                ></div>
                <span class="text-sm font-medium text-indigo-700"
                    >Online</span
                >
            </div>
            <div
                id="current-time"
                class="text-sm font-medium text-gray-600"
            ></div>
            <button
                id="toggle-theme"
                class="w-9 h-9 rounded-full flex items-center justify-center bg-white shadow-sm hover:bg-gray-50 transition"
            >
                <i class="fas fa-moon text-indigo-600"></i>
            </button>
        </div>
    </div>
</header>