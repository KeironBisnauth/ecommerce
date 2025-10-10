<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller

{
public function index ($id)
{
//checking for creds and group
$group_ids =Auth::check() ? Auth::user()->getGroups(): [1];


//fetching data for one product based on product ID
$data = Product::singleProduct($id)->withPrices()->get()->first();

//passes data to details page
return view('pages.default.detailspage', compact('data'));


}
}
