<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class HomeController extends Controller
{
    public function index()
    {
        $items = Address::all();
        // dd($item);

        return view('welcome', compact('items'));
    }
}
