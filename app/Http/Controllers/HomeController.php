<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
          $products = product::all(); // or paginate, or limit as needed
        
            $categories = category::all(); // or appropriate logic
          
        return view('Dashboard.home', compact('products', 'categories'));
    }
 

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
