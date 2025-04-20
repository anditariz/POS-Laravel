@extends('layouts.main')
@section('title', 'Data Products')
@section('content')
    <div id="products-section">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">
                    Product Management
                </h2>
                <button id="add-product-btn"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center">
                    <i class="fas fa-plus mr-2"></i> Add Product
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Image
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stock
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="products-table-body">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ $product->image }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">Electronic</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $product->price }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-indigo-600 hover:text-indigo-900 mr-3 edit-product eg-modal-toogle"
                                        data-id="edit-modal-{{ $product->id }}">Edit</button>
                                    <button class="text-red-600 hover:text-red-900 delete-product eg-modal-toogle"
                                        data-id="delete-modal-{{$product->id}}">Delete</button>
                                </td>
                            </tr>
                            <div id="edit-modal-{{$product->id}}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                                <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 slide-up">
                                    <div class="p-6">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="text-xl font-semibold" id="modal-title">
                                                Edit Product
                                            </h3>
                                            <button class="text-gray-500 eg-close-modal hover:text-gray-700">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>

                                        <form id="product-form" action="{{ route('products.update' , $product->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf @method('put')
                                            <input name='id' type="hidden" id="product-id" />
                                            <div class="mb-4">
                                                <label for="product-name"
                                                    class="block text-sm font-medium text-gray-700 mb-1">Product
                                                    Name</label>
                                                <input value="{{$product->name}}" type="text" id="product-name" name="name"
                                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                    required />
                                            </div>

                                            <div class="mb-4">
                                                <label for="description-name"
                                                    class="block text-sm font-medium text-gray-700 mb-1">Product
                                                    Decription</label>
                                                <textarea type="text" id="description-name" name="description"
                                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>{{$product->description}}</textarea>
                                            </div>

                                            <div class="mb-4">
                                                <label for="product-category"
                                                    class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                                <select id="product-category"
                                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                    required>
                                                    <option value="">Select a category</option>
                                                    <option {{ $product->category == "Electronics" ? 'selected' : '' }} value="Electronics">Electronics</option>
                                                    <option {{ $product->category == "Clothing" ? 'selected' : '' }} value="Clothing">Clothing</option>
                                                    <option {{ $product->category == "Food" ? 'selected' : '' }} value="Food">Food</option>
                                                    <option {{ $product->category == "Beverages" ? 'selected' : '' }} value="Beverages">Beverages</option>
                                                    <option {{ $product->category == "Other" ? 'selected' : '' }} value="Other">Other</option>
                                                </select>
                                            </div>

                                            <div class="mb-4">
                                                <label for="product-price"
                                                    class="block text-sm font-medium text-gray-700 mb-1">Price (Rp)</label>
                                                <input value="{{$product->price}}" type="number" id="product-price" min="0" name="price"
                                                    step="0.01"
                                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                    required />
                                            </div>

                                            <div class="mb-4">
                                                <label 
                                                    for="product-stock"
                                                    class="block text-sm font-medium text-gray-700 mb-4">Stock
                                                    Quantity</label>
                                                <input value="{{$product->stock}}" type="number" id="product-stock" name = "stock" min="0"
                                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                    required />
                                            </div>

                                            <div class="mb-4">
                                                <label for="product-image"
                                                    class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                                                <input 
                                                    value="{{$product->image}}"
                                                    type="text" id="product-image" name="image"
                                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                    placeholder="https://example.com/image.jpg" />
                                            </div>

                                            <div class="flex justify-end space-x-3 pt-4">
                                                <button type="button"
                                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 eg-close-modal transition">
                                                    Cancel
                                                </button>
                                                <button type="submit"
                                                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                                    Save Product
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
  
                            <div id="delete-modal-{{$product->id}}" class="fixed inset-0 z-50 flex items-center justify-center hidden">
                                <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
                                
                                <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full mx-4 slide-up">
                                  <!-- Modal header -->
                                  <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t">
                                    <h3 class="text-xl font-semibold text-gray-900">Delete Confirmation</h3>
                                    <button type="button" class="text-gray-400 hover:text-gray-500 eg-close-modal">
                                      <span class="sr-only">Close</span>
                                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                      </svg>
                                    </button>
                                  </div>
                                  
                                  <!-- Modal body -->
                                  <div class="p-6 space-y-4">
                                    <div class="flex items-center justify-center text-red-500 mb-4">
                                      <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                      </svg>
                                    </div>
                                    <p class="text-center text-gray-700">Are you sure you want to delete this item?</p>
                                    <p class="text-center text-sm text-red-600 font-medium">This action cannot be undone. All data will be permanently removed.</p>
                                  </div>
                                  
                                  <!-- Modal footer -->
                                  <div class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b">
                                    <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 eg-close-modal">
                                      Cancel
                                    </button>
                                    
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button id="confirmDeleteBtn" type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Delete
                                        </button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="product-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 slide-up">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold" id="modal-title">
                            Add New Product
                        </h3>
                        <button id="close-modal" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <form id="product-form" action="{{ route('products.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input name='id' type="hidden" id="product-id" />
                        <div class="mb-4">
                            <label for="product-name" class="block text-sm font-medium text-gray-700 mb-1">Product
                                Name</label>
                            <input type="text" id="product-name" name="name"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                required />
                        </div>

                        <div class="mb-4">
                            <label for="description-name" class="block text-sm font-medium text-gray-700 mb-1">Product
                                Decription</label>
                            <textarea type="text" id="description-name" name="description"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="product-category"
                                class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select id="product-category"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                required>
                                <option value="">Select a category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Clothing">Clothing</option>
                                <option value="Food">Food</option>
                                <option value="Beverages">Beverages</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="product-price" class="block text-sm font-medium text-gray-700 mb-1">Price
                                (Rp)</label>
                            <input type="number" id="product-price" min="0" name="price" step="0.01"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                required />
                        </div>

                        <div class="mb-4">
                            <label for="product-stock" class="block text-sm font-medium text-gray-700 mb-4">Stock
                                Quantity</label>
                            <input type="number" id="product-stock" name = "stock" min="0"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                required />
                        </div>

                        <div class="mb-4">
                            <label for="product-image" class="block text-sm font-medium text-gray-700 mb-1">Image
                                URL</label>
                            <input type="text" id="product-image" name="image"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                placeholder="https://example.com/image.jpg" />
                        </div>

                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" id="cancel-product"
                                class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
