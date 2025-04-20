<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modern POS System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");


        @media print {
            body * {
                    visibility: hidden;
                }
                #receipt-content,
                #receipt-content * {
                    visibility: visible;
                }
                #receipt-content {
                    position: absolute;
                    left: 0;
                    top: 0;
                    border: none;
                    width: 100%;
                }
                .no-print {
                    display: none !important;
                }
        }
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
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.inc.sidebar')
        <!-- Main Content -->
        <div class="flex flex-col flex-1 min-h-screen">
            <!-- App Header -->
            @include('layouts.inc.header')
            <!-- Main Container -->
            <div class="flex flex-col">
                <!-- Main Content -->
                <main class="flex-1 container mx-auto px-4 py-6">
                    @yield('content')
                </main>
            </div>

        </div>
    </div>

    <script>
        // Sample product data
        let products = [];
        let cart = [];
        let isDarkMode = false;

        let activeClassList = ["text-white", "bg-indigo-700"];
        let dectiveClassList = ["text-indigo-200", "hover:text-white", "hover:bg-indigo-700"];

        const dashboardButtonSidebar = document.getElementById("dashboardButtonSidebar");
        const productsButtonSidebar = document.getElementById("productsButtonSidebar");
        const modalButton = document.querySelectorAll('.eg-modal-toogle');

        

        // DOM Elements
        const productGrid = document.getElementById("product-grid");
        const cartItems = document.getElementById("cart-items");
        const subtotalEl = document.getElementById("subtotal");
        const taxEl = document.getElementById("tax");
        const totalEl = document.getElementById("total");
        const checkoutBtn = document.getElementById("checkout-btn");
        const productsTableBody = document.getElementById(
            "products-table-body"
        );
        const closeModalBtn = document.getElementById("close-modal");
        const cancelProductBtn = document.getElementById("cancel-product");
        const addProductBtn = document.getElementById("add-product-btn");
        const productModal = document.getElementById("product-modal");

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


        function modalInisiate() {
            modalButton.forEach((btn) => {
                btn.addEventListener("click", (e) => {
                    modalTargetId = e.target.getAttribute("data-id")
                    modal = document.getElementById(modalTargetId)
                    if (modal) {
                        modal.classList.remove("hidden");
                    }

                    closeButton = document.querySelectorAll(`#${modalTargetId} .eg-close-modal`)
                    closeButton.forEach((closeBtn) => {
                        closeBtn.addEventListener("click" , (e)=> {
                            modal.classList.add("hidden");
                        });
                    });
                });
            });
        }

        // Initialize
        document.addEventListener("DOMContentLoaded", () => {
            updateCurrentTime();
            modalInisiate();
            setInterval(updateCurrentTime, 1000);
            console.log(receiptModal)
            console.log(checkoutBtn)

            if (window.location.pathname == "/dashboard") {
                axios.get('http://127.0.0.1:8000/product/get-all')
                    .then(function(response) {
                        // const posts = response.data;
                        renderProductGrid(response.data);
                        products = response.data;
                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                    });
                changeSidebar(dashboardButtonSidebar);
                updateCartUI();
            } else if (window.location.pathname == "/products") {
                changeSidebar(productsButtonSidebar);
            }

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

        function changeSidebar(reference) {
            activeClassList.forEach((cls) => {
                reference.classList.add(cls)
            })
            dectiveClassList.forEach((cls) => {
                reference.classList.remove(cls)
            })
        };

        if (addProductBtn) {
            addProductBtn.addEventListener("click", openAddProductModal);
        }

        function openAddProductModal() {
            productModal.classList.remove("hidden");
        }
        
        if (closeModalBtn) {
            closeModalBtn.addEventListener("click", () => {
                productModal.classList.add("hidden");
        });
        }

        if (cancelProductBtn) {
            cancelProductBtn.addEventListener("click", () => {
                productModal.classList.add("hidden");
            });
        }

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
        function renderProductGrid(datas) {
            productGrid.innerHTML = "";

            datas.forEach((product) => {
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

        function renderProductsTable(datas) {

            // Add event listeners to edit and delete buttons
            document.querySelectorAll(".edit-product").forEach((btn) => {
                btn.addEventListener("click", (e) => {
                    const productId = parseInt(
                        e.target.getAttribute("data-id")
                    );
                    editProduct(productId);
                });
            });

            document.querySelectorAll(".delete-product").forEach((btn) => {
                btn.addEventListener("click", (e) => {
                    const productId = parseInt(
                        e.target.getAttribute("data-id")
                    );
                    deleteProduct(productId);
                });
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
            window.print();
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
