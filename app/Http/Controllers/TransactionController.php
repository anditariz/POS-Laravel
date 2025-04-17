<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Orders;
use App\Models\orderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;




class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Orders";
        $datas = Orders::orderBy('id', 'desc')->get();
        return view('pos.index', compact('title', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::orderBy('id', 'desc')->get();
        return view('pos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ORD-100425001
        $qOrderCode = Orders::max('id');
        $qOrderCode++;
        $orderCode = "ORD" . date("dmy") . sprintf("%03d", $qOrderCode);
        $data = [
            'order_code' => $orderCode,
            'order_date' => date("Y-m-d"),
            'order_amount' => $request->grandtotal,
            'order_change' => 1,
            'order_status' => 1,
        ];

        $order = Orders::create($data);
        $qty = $request->qty;
        foreach ($qty as $key => $data) {
            $order_details = orderDetails::create([
                'order_id' => $order->id,
                'product_id' => $request->product_id[$key],
                'qty' => $request->qty[$key],
                'order_price' => $request->order_price[$key],
                'order_subtotal' => $request->order_subtotal[$key],
            ]);
            return $order_details;
        }

        if ($request->hasFile('product_photo')) {
            $photo = $request->file('product_photo')->store('products', 'public');
            $data['product_photo'] = $photo;
        }

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

        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_description = $request->product_description;
        $product->is_active = $request->is_active;


        if ($request->hasFile('product_photo')) {
            if ($product->product_photo) {
                File::delete(public_path('storage/' . $product->product_photo));
            }

            $photo = $request->file('product_photo')->store('products', 'public');
            $product->product_photo = $photo;
        }

        $product->save();
        Alert::image(
            'Product Updated!',
            'Product update was successful!',
            asset('storage/products/download.jpg'),
            '500px',
            '250px',
            'Product Success Image'
        );


        return redirect()->route('products.index');

    }

    public function destroy(string $id)
    {
        $product = Products::find($id);
        File::delete(public_path('storage/' . $product->product_photo));
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    public function getProduct($category_id)
    {
        $products = Products::where('category_id', $category_id)->get();
        $response = ['status' => 'success', 'message' => 'Fetch Product Success', 'data' => $products];
        return response()->json($response, 200);
    }


    public function show($id)
    {
        //order 
        $order = Orders::findOrFail($id);
        $orderDetails = orderDetails::with('product')->where('order_id', $id)->get();
        $title = "Order Details Of " . $order->order_code;
        return view('pos.show', compact('order', 'orderDetails', 'title'));
    }

    public function print($id)
    {
        $order = Orders::findOrFail($id);
        $orderDetails = OrderDetails::with('product')->where('order_id', $id)->get();
        return view('pos.print-struk', compact('order', 'orderDetails'));

    }

}
