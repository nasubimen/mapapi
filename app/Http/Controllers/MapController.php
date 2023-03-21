<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class MapController extends Controller
{
    public function index()
    {
        $items = Address::all();
        // dd($item);

        return view('welcome', compact('items'));
    }
}
