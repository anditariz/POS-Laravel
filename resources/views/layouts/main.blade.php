<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modern POS System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

      body {
        font-family: "Poppins", sans-serif;
      }

      .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .cart-item {
            transition: all 0.3s ease;
        }
        .cart-item:hover {
            background-color: rgba(249, 250, 251, 0.8);
        }
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .slide-up {
            animation: slideUp 0.3s ease-out;
        }
        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
            }
    </style>
  </head>
  <body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
      <!-- Sidebar -->
      @include('layouts.inc.sidebar')

      <!-- Main Content -->
      <div class="flex flex-col flex-1 overflow-hidden">
        <!-- App Header -->
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
        <!-- Main Container -->
        <div class="flex flex-col min-h-screen">

            <!-- Main Content -->
            <main class="flex-1 container mx-auto px-4 py-6">
                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- Products Section -->
                    <div class="flex-1">
                        <div
                            class="bg-white rounded-2xl shadow-sm overflow-hidden"
                        >
                            <!-- Products Header -->
                            <div
                                class="bg-gradient-to-r from-indigo-50 to-purple-50 px-6 py-4 border-b"
                            >
                                <div class="flex justify-between items-center">
                                    <h2
                                        class="text-xl font-semibold text-gray-800"
                                    >
                                        Products
                                    </h2>
                                    <div class="relative w-64">
                                        <input
                                            type="text"
                                            placeholder="Search products..."
                                            class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm"
                                        />
                                        <i
                                            class="fas fa-search absolute left-3 top-3 text-gray-400"
                                        ></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Category Tabs -->
                            <div
                                class="px-6 py-3 border-b flex overflow-x-auto scrollbar-hide"
                            >
                                <button
                                    class="category-tab active px-4 py-1.5 rounded-full bg-indigo-600 text-white text-sm font-medium mr-2 whitespace-nowrap"
                                >
                                    All Items
                                </button>
                                <button
                                    class="category-tab px-4 py-1.5 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium mr-2 whitespace-nowrap"
                                >
                                    Electronics
                                </button>
                                <button
                                    class="category-tab px-4 py-1.5 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium mr-2 whitespace-nowrap"
                                >
                                    Food & Drinks
                                </button>
                                <button
                                    class="category-tab px-4 py-1.5 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium mr-2 whitespace-nowrap"
                                >
                                    Clothing
                                </button>
                                <button
                                    class="category-tab px-4 py-1.5 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium whitespace-nowrap"
                                >
                                    Accessories
                                </button>
                            </div>

                            <!-- Product Grid -->
                            <div class="p-6">
                                <div
                                    class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 gap-4"
                                    id="product-grid"
                                >
                                    <!-- Product cards will be loaded here -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Section -->
                    <div class="w-full lg:w-96">
                        <div
                            class="bg-white rounded-2xl shadow-sm overflow-hidden h-full flex flex-col"
                        >
                            <!-- Cart Header -->
                            <div
                                class="bg-gradient-to-r from-indigo-50 to-purple-50 px-6 py-4 border-b"
                            >
                                <div class="flex justify-between items-center">
                                    <h2
                                        class="text-xl font-semibold text-gray-800"
                                    >
                                        Current Order
                                    </h2>
                                    <button
                                        id="clear-cart"
                                        class="text-sm font-medium text-red-500 hover:text-red-700 flex items-center"
                                    >
                                        <i class="fas fa-trash-alt mr-1"></i>
                                        Clear
                                    </button>
                                </div>
                            </div>

                            <!-- Cart Items -->
                            <div
                                class="flex-1 overflow-y-auto px-4 py-3"
                                id="cart-items"
                            >
                                <!-- Empty cart state -->
                                <div class="text-center py-10">
                                    <div
                                        class="mx-auto w-24 h-24 rounded-full bg-indigo-50 flex items-center justify-center mb-4"
                                    >
                                        <i
                                            class="fas fa-shopping-basket text-3xl text-indigo-400"
                                        ></i>
                                    </div>
                                    <h3
                                        class="text-lg font-medium text-gray-700 mb-1"
                                    >
                                        Your cart is empty
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        Add products to get started
                                    </p>
                                </div>
                            </div>

                            <!-- Cart Summary -->
                            <div class="border-t p-4 bg-gray-50">
                                <div class="space-y-3 mb-4">
                                    <div class="flex justify-between">
                                        <span
                                            class="text-sm font-medium text-gray-600"
                                            >Subtotal:</span
                                        >
                                        <span
                                            id="subtotal"
                                            class="text-sm font-medium text-gray-800"
                                            >$0.00</span
                                        >
                                    </div>
                                    <div class="flex justify-between">
                                        <span
                                            class="text-sm font-medium text-gray-600"
                                            >Tax (10%):</span
                                        >
                                        <span
                                            id="tax"
                                            class="text-sm font-medium text-gray-800"
                                            >$0.00</span
                                        >
                                    </div>
                                    <div
                                        class="flex justify-between pt-2 border-t"
                                    >
                                        <span
                                            class="font-semibold text-gray-800"
                                            >Total:</span
                                        >
                                        <span
                                            id="total"
                                            class="font-semibold text-indigo-600"
                                            >$0.00</span
                                        >
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <button
                                        id="checkout-btn"
                                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-lg font-medium hover:shadow-md transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
                                        disabled
                                    >
                                        <i class="fas fa-credit-card mr-2"></i>
                                        Checkout
                                    </button>
                                    <button
                                        id="print-receipt-btn"
                                        class="w-full bg-white border border-gray-200 text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-50 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
                                        disabled
                                    >
                                        <i class="fas fa-print mr-2"></i> Print
                                        Receipt
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Receipt Modal -->
        <div
            id="receipt-modal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden"
        >
            <div
                class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 slide-up"
            >
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">
                            Order Receipt
                        </h3>
                        <button
                            id="close-receipt"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div
                        id="receipt-content"
                        class="bg-white p-4 border border-gray-100 rounded-lg"
                    >
                        <div class="text-center mb-4">
                            <div
                                class="mx-auto w-16 h-16 rounded-full bg-gradient-to-r from-indigo-100 to-purple-100 flex items-center justify-center mb-2"
                            >
                                <i
                                    class="fas fa-store text-2xl text-indigo-600"
                                ></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">
                                LUMINA STORE
                            </h2>
                            <p class="text-xs text-gray-500">
                                123 Business Avenue, City
                            </p>
                            <p class="text-xs text-gray-500">
                                Tel: (123) 456-7890
                            </p>
                        </div>

                        <div
                            class="border-t border-b border-gray-100 py-3 my-3"
                        >
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-500">Date:</span>
                                <span id="receipt-date" class="font-medium"
                                    >Oct 15, 2023 14:30</span
                                >
                            </div>
                            <div class="flex justify-between text-xs mt-1">
                                <span class="text-gray-500">Order #:</span>
                                <span id="receipt-order-id" class="font-medium"
                                    >ORD-12345</span
                                >
                            </div>
                        </div>

                        <div class="mb-4">
                            <div
                                class="grid grid-cols-12 gap-1 text-xs font-medium border-b border-gray-100 pb-1 mb-1"
                            >
                                <div class="col-span-6">Item</div>
                                <div class="col-span-2 text-right">Qty</div>
                                <div class="col-span-2 text-right">Price</div>
                                <div class="col-span-2 text-right">Total</div>
                            </div>

                            <div id="receipt-items" class="space-y-2 mt-2">
                                <!-- Receipt items will be loaded here -->
                            </div>

                            <div class="border-t border-gray-100 pt-3 mt-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal:</span>
                                    <span
                                        id="receipt-subtotal"
                                        class="font-medium"
                                        >$0.00</span
                                    >
                                </div>
                                <div class="flex justify-between text-sm mt-1">
                                    <span class="text-gray-600"
                                        >Tax (10%):</span
                                    >
                                    <span id="receipt-tax" class="font-medium"
                                        >$0.00</span
                                    >
                                </div>
                                <div
                                    class="flex justify-between font-semibold mt-2 pt-2 border-t border-gray-100"
                                >
                                    <span>Total:</span>
                                    <span
                                        id="receipt-total"
                                        class="text-indigo-600"
                                        >$0.00</span
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="text-center text-xs text-gray-500 mt-4">
                            <p>Thank you for shopping with us!</p>
                            <p class="mt-1">Please visit again</p>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button
                            id="print-receipt"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center"
                        >
                            <i class="fas fa-print mr-2"></i> Print Receipt
                        </button>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </div>
  
    <script>
        // Sample product data
        const products = [
            {
                id: 1,
                name: 'MacBook Pro 14"',
                category: "Electronics",
                price: 1999.99,
                stock: 8,
                image: "https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80",
            },
            {
                id: 2,
                name: "iPhone 14 Pro",
                category: "Electronics",
                price: 999.99,
                stock: 15,
                image: "https://images.unsplash.com/photo-1663499482523-1c0c1bae4ce1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80",
            },
            {
                id: 3,
                name: "AirPods Pro",
                category: "Electronics",
                price: 249.99,
                stock: 20,
                image: "https://images.unsplash.com/photo-1590658268037-6bf12165a8df?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1332&q=80",
            },
            {
                id: 4,
                name: "Premium Coffee",
                category: "Food & Drinks",
                price: 12.99,
                stock: 50,
                image: "https://images.unsplash.com/photo-1517705008128-361805f42e86?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80",
            },
            {
                id: 5,
                name: "Organic Tea",
                category: "Food & Drinks",
                price: 8.99,
                stock: 45,
                image: "https://images.unsplash.com/photo-1560343090-f0409e384916?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80",
            },
            {
                id: 6,
                name: "Designer T-Shirt",
                category: "Clothing",
                price: 29.99,
                stock: 30,
                image: "https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80",
            },
            {
                id: 7,
                name: "Leather Wallet",
                category: "Accessories",
                price: 49.99,
                stock: 25,
                image: "https://images.unsplash.com/photo-1600857544200-b2f666a9a1e2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80",
            },
            {
                id: 8,
                name: "Smart Watch",
                category: "Electronics",
                price: 299.99,
                stock: 12,
                image: "https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1399&q=80",
            },
        ];

        let cart = [];
        let isDarkMode = false;

        // DOM Elements
        const productGrid = document.getElementById("product-grid");
        const cartItems = document.getElementById("cart-items");
        const subtotalEl = document.getElementById("subtotal");
        const taxEl = document.getElementById("tax");
        const totalEl = document.getElementById("total");
        const checkoutBtn = document.getElementById("checkout-btn");
        const printReceiptBtn =
            document.getElementById("print-receipt-btn");
        const clearCartBtn = document.getElementById("clear-cart");
        const receiptModal = document.getElementById("receipt-modal");
        const closeReceiptBtn = document.getElementById("close-receipt");
        const printReceiptBtnModal =
            document.getElementById("print-receipt");
        const receiptItems = document.getElementById("receipt-items");
        const receiptSubtotal = document.getElementById("receipt-subtotal");
        const receiptTax = document.getElementById("receipt-tax");
        const receiptTotal = document.getElementById("receipt-total");
        const receiptDate = document.getElementById("receipt-date");
        const receiptOrderId = document.getElementById("receipt-order-id");
        const currentTimeEl = document.getElementById("current-time");
        const toggleThemeBtn = document.getElementById("toggle-theme");
        const categoryTabs = document.querySelectorAll(".category-tab");

        // Initialize
        document.addEventListener("DOMContentLoaded", () => {
            updateCurrentTime();
            setInterval(updateCurrentTime, 1000);

            renderProductGrid();
            updateCartUI();

            // Add event listeners to category tabs
            categoryTabs.forEach((tab) => {
                tab.addEventListener("click", () => {
                    categoryTabs.forEach((t) =>
                        t.classList.remove(
                            "active",
                            "bg-indigo-600",
                            "text-white"
                        )
                    );
                    categoryTabs.forEach((t) =>
                        t.classList.add(
                            "bg-white",
                            "border",
                            "border-gray-200",
                            "text-gray-600"
                        )
                    );

                    tab.classList.add(
                        "active",
                        "bg-indigo-600",
                        "text-white"
                    );
                    tab.classList.remove(
                        "bg-white",
                        "border",
                        "border-gray-200",
                        "text-gray-600"
                    );

                    // Filter products by category (simplified for demo)
                    const category = tab.textContent.trim();
                    if (category === "All Items") {
                        renderProductGrid();
                    } else {
                        // In a real app, you would filter products by category
                        console.log(`Filtering by: ${category}`);
                    }
                });
            });
        });

        // Update current time
        function updateCurrentTime() {
            const now = new Date();
            const options = {
                weekday: "short",
                month: "short",
                day: "numeric",
                hour: "2-digit",
                minute: "2-digit",
            };
            currentTimeEl.textContent = now.toLocaleDateString(
                "en-US",
                options
            );
        }

        // Render product grid
        function renderProductGrid() {
            productGrid.innerHTML = "";

            products.forEach((product) => {
                const productCard = document.createElement("div");
                productCard.className =
                    "product-card bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:border-indigo-100 transition cursor-pointer";
                productCard.innerHTML = `
                <div class="relative pt-[100%]">
                    <img src="${product.image}" alt="${
                    product.name
                }" class="absolute top-0 left-0 w-full h-full object-cover">
                    ${
                        product.stock <= 5
                            ? `<div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">Low stock</div>`
                            : ""
                    }
                </div>
                <div class="p-3">
                    <h3 class="font-medium text-gray-800 truncate">${
                        product.name
                    }</h3>
                    <p class="text-xs text-gray-500 mt-1">${
                        product.category
                    }</p>
                    <div class="flex justify-between items-center mt-3">
                        <span class="font-bold text-indigo-600">$${product.price.toFixed(
                            2
                        )}</span>
                        <button class="add-to-cart-btn w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center hover:bg-indigo-700 transition" data-id="${
                            product.id
                        }">
                            <i class="fas fa-plus text-xs"></i>
                        </button>
                    </div>
                </div>
            `;

                productCard
                    .querySelector(".add-to-cart-btn")
                    .addEventListener("click", (e) => {
                        e.stopPropagation();
                        addToCart(product);
                    });

                productGrid.appendChild(productCard);
            });
        }

        // Add product to cart
        function addToCart(product) {
            if (product.stock <= 0) {
                showNotification("This product is out of stock!", "error");
                return;
            }

            const existingItem = cart.find(
                (item) => item.id === product.id
            );

            if (existingItem) {
                if (existingItem.quantity < product.stock) {
                    existingItem.quantity++;
                } else {
                    showNotification(
                        "Cannot add more than available stock!",
                        "error"
                    );
                    return;
                }
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    quantity: 1,
                    image: product.image,
                });
            }

            updateCartUI();
            showNotification(`${product.name} added to cart`, "success");
        }

        // Update cart UI
        function updateCartUI() {
            cartItems.innerHTML = "";

            if (cart.length === 0) {
                cartItems.innerHTML = `
                <div class="text-center py-10">
                    <div class="mx-auto w-24 h-24 rounded-full bg-indigo-50 flex items-center justify-center mb-4">
                        <i class="fas fa-shopping-basket text-3xl text-indigo-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-700 mb-1">Your cart is empty</h3>
                    <p class="text-sm text-gray-500">Add products to get started</p>
                </div>
            `;

                subtotalEl.textContent = "$0.00";
                taxEl.textContent = "$0.00";
                totalEl.textContent = "$0.00";

                checkoutBtn.disabled = true;
                printReceiptBtn.disabled = true;

                return;
            }

            let subtotal = 0;

            cart.forEach((item) => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;

                const cartItem = document.createElement("div");
                cartItem.className =
                    "cart-item flex justify-between items-center p-3 border-b border-gray-100";
                cartItem.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-lg overflow-hidden">
                        <img src="${item.image}" alt="${
                    item.name
                }" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-800">${
                            item.name
                        }</h4>
                        <p class="text-xs text-gray-500">$${item.price.toFixed(
                            2
                        )}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <button class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center decrease-quantity hover:bg-gray-200 transition" data-id="${
                        item.id
                    }">
                        <i class="fas fa-minus text-xs text-gray-600"></i>
                    </button>
                    <span class="text-sm font-medium w-5 text-center">${
                        item.quantity
                    }</span>
                    <button class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center increase-quantity hover:bg-gray-200 transition" data-id="${
                        item.id
                    }">
                        <i class="fas fa-plus text-xs text-gray-600"></i>
                    </button>
                    <button class="w-7 h-7 rounded-full bg-red-100 flex items-center justify-center remove-item hover:bg-red-200 transition" data-id="${
                        item.id
                    }">
                        <i class="fas fa-trash-alt text-xs text-red-600"></i>
                    </button>
                </div>
            `;

                cartItems.appendChild(cartItem);
            });

            // Add event listeners to quantity buttons
            document
                .querySelectorAll(".increase-quantity")
                .forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        const productId = parseInt(
                            e.target
                                .closest("button")
                                .getAttribute("data-id")
                        );
                        const cartItem = cart.find(
                            (item) => item.id === productId
                        );
                        const product = products.find(
                            (p) => p.id === productId
                        );

                        if (cartItem.quantity < product.stock) {
                            cartItem.quantity++;
                            updateCartUI();
                        } else {
                            showNotification(
                                "Cannot add more than available stock!",
                                "error"
                            );
                        }
                    });
                });

            document
                .querySelectorAll(".decrease-quantity")
                .forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        const productId = parseInt(
                            e.target
                                .closest("button")
                                .getAttribute("data-id")
                        );
                        const cartItem = cart.find(
                            (item) => item.id === productId
                        );

                        if (cartItem.quantity > 1) {
                            cartItem.quantity--;
                        } else {
                            cart = cart.filter(
                                (item) => item.id !== productId
                            );
                        }

                        updateCartUI();
                    });
                });

            document.querySelectorAll(".remove-item").forEach((btn) => {
                btn.addEventListener("click", (e) => {
                    const productId = parseInt(
                        e.target.closest("button").getAttribute("data-id")
                    );
                    cart = cart.filter((item) => item.id !== productId);
                    updateCartUI();
                    showNotification("Item removed from cart", "info");
                });
            });

            const tax = subtotal * 0.1;
            const total = subtotal + tax;

            subtotalEl.textContent = `$${subtotal.toFixed(2)}`;
            taxEl.textContent = `$${tax.toFixed(2)}`;
            totalEl.textContent = `$${total.toFixed(2)}`;

            checkoutBtn.disabled = false;
            printReceiptBtn.disabled = false;
        }

        // Show notification
        function showNotification(message, type) {
            // In a real app, you would implement a proper notification system
            console.log(`${type.toUpperCase()}: ${message}`);
        }

        // Checkout
        function checkout() {
            if (cart.length === 0) return;

            // In a real app, you would process the payment and update inventory
            const subtotal = cart.reduce(
                (sum, item) => sum + item.price * item.quantity,
                0
            );
            const tax = subtotal * 0.1;
            const total = subtotal + tax;

            const order = {
                id: Date.now(),
                date: new Date(),
                items: [...cart],
                subtotal,
                tax,
                total,
            };

            // Show receipt
            showReceipt(order);

            // Clear cart
            cart = [];
            updateCartUI();

            showNotification("Order completed successfully!", "success");
        }

        // Show receipt
        function showReceipt(order) {
            receiptItems.innerHTML = "";

            order.items.forEach((item) => {
                const itemTotal = item.price * item.quantity;

                const itemRow = document.createElement("div");
                itemRow.className = "grid grid-cols-12 gap-1 text-sm mb-2";
                itemRow.innerHTML = `
                <div class="col-span-6 truncate">${item.name}</div>
                <div class="col-span-2 text-right">${item.quantity}</div>
                <div class="col-span-2 text-right">$${item.price.toFixed(
                    2
                )}</div>
                <div class="col-span-2 text-right">$${itemTotal.toFixed(
                    2
                )}</div>
            `;

                receiptItems.appendChild(itemRow);
            });

            receiptSubtotal.textContent = `$${order.subtotal.toFixed(2)}`;
            receiptTax.textContent = `$${order.tax.toFixed(2)}`;
            receiptTotal.textContent = `$${order.total.toFixed(2)}`;

            const now = new Date();
            const options = {
                year: "numeric",
                month: "short",
                day: "numeric",
                hour: "2-digit",
                minute: "2-digit",
            };
            receiptDate.textContent = now.toLocaleDateString(
                "en-US",
                options
            );
            receiptOrderId.textContent = `ORD-${order.id
                .toString()
                .slice(-5)}`;

            receiptModal.classList.remove("hidden");
        }

        // Event Listeners
        checkoutBtn.addEventListener("click", checkout);

        printReceiptBtn.addEventListener("click", () => {
            if (cart.length > 0) {
                const subtotal = cart.reduce(
                    (sum, item) => sum + item.price * item.quantity,
                    0
                );
                const tax = subtotal * 0.1;
                const total = subtotal + tax;

                const tempOrder = {
                    id: Date.now(),
                    date: new Date(),
                    items: [...cart],
                    subtotal,
                    tax,
                    total,
                };

                showReceipt(tempOrder);
            }
        });

        clearCartBtn.addEventListener("click", () => {
            if (
                cart.length > 0 &&
                confirm("Are you sure you want to clear your cart?")
            ) {
                cart = [];
                updateCartUI();
                showNotification("Cart cleared", "info");
            }
        });

        closeReceiptBtn.addEventListener("click", () => {
            receiptModal.classList.add("hidden");
        });

        printReceiptBtnModal.addEventListener("click", () => {
            // In a real app, you would implement proper printing
            console.log("Printing receipt...");
            alert("Receipt printing would be implemented in a real app");
        });

        // Toggle theme
        toggleThemeBtn.addEventListener("click", () => {
            isDarkMode = !isDarkMode;

            if (isDarkMode) {
                document.documentElement.classList.add("dark");
                toggleThemeBtn.innerHTML =
                    '<i class="fas fa-sun text-yellow-400"></i>';
            } else {
                document.documentElement.classList.remove("dark");
                toggleThemeBtn.innerHTML =
                    '<i class="fas fa-moon text-indigo-600"></i>';
            }
        });
    </script>
</body>
</html>
