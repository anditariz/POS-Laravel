@extends('layouts.main') @section('title', 'Point Of Sale')
@section('content')
<section>
    <form action="{{ route('pos.store') }}" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h5 align="center" class="card-title">Select Categories</h5>
                        @csrf
                        <div align="left" class="mt2">
                            <a
                                href="{{ url()->previous() }}"
                                class="btn btn-warning">Back
                            </a>
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label">Category Name</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Select One</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="col-form-label">Product Name *</label>
                            <select name="" id="product_id" class="form-control">
                                <option value="">Select One</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary add-row" type="button">
                                Add To Chart
                            </button>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Basket</h5>
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark" align="center">
                                <tr>
                                    <th>Photo</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Sub Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                <tfoot>
                                    <!-- <tr>
                                        <td colspan="2">
                                            <input type="number" class="form-control">
                                        </td> -->
                                        <tr>
                                            <td colspan="2">Grand Total</td>
                                            <td colspan="3" class="text-end pe-4">
                                                <span class="grandtotal"></span>
                                                <input type="hidden" class="form-control" name="grandtotal" readonly>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-success">Confirm Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</section>
@endsection
