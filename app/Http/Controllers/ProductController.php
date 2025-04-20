<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;


class ProductController extends Controller
{

    public function getProduct()
    {
        $datas = Products::get();
        return response()->json($datas->toArray());
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Products";
        $products = Products::get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::orderBy('id', 'desc')->get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            // 'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
            'stock' => $request->stock,
            'category' => 'Product',
            'description' => $request->description,
            'is_active' => true,
        ];
        // if($request->hasFile('product_photo')) {
        //     $photo = $request->file('product_photo')->store('products', 'public');
        //     $data['product_photo'] = $photo;
        // }

        Products::create($data);

        return redirect()->route('products.index')->with('success', 'Product added successfully');

    }

   public function edit($id)
    {
        $edit = Products::find($id);
        $categories = Categories::orderBy('id', 'desc')->get();
        return view('products.edit', compact('edit', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $product = Products::find($id);

        $product->id = $id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock;
    // $product->is_active = $request->is_active;


    // if ($request->hasFile('product_photo')) {
    //     if ($product->product_photo) {
    //         File::delete(public_path('storage/' . $product->product_photo));
    //     }

    //     $photo = $request->file('product_photo')->store('products', 'public');
    //     $product->product_photo = $photo;
    // }

        $product->save();
    // Alert::image('Product Updated!','Product update was successful!',
    // asset('storage/products/download.jpg'),'500px','250px','Product Success Image');


    return redirect()->route('products.index');

    }

    public function destroy(string $id)
    {
        $product = Products::find($id);
        // File::delete(public_path('storage/' . $product->product_photo));
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

}
