<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illumincate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // check if the use is authenticated and which group the user belongs to
        $group_ids = Auth::check() ? Auth::user()->getGroups() : [1];

        // fetch data from products table
        $product_data = Product::withPrices()->get();

        // pass product information to views
        return view('pages.default.productspage', compact('product_data'));
    }
}
