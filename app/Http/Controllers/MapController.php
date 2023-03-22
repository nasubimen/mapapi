<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class MapController extends Controller
{
    public function index(Request $request)
    {
        $query = Address::query();
        if (!empty($request->input('search1'))) {
            $search_split = mb_convert_kana($request->input('search1'), 's');
            $search_split2 = preg_split('/[\s]+/', $search_split);
            foreach ($search_split2 as $value) {
                $query->Where('name', 'LIKE', "%{$value}%");
            }
        }
        if (!is_null($request->input('search2'))) {
            $query->Where('type', $request->input('search2'));
        }
        $items = $query->get();
        // dd($items);
        return view('welcome', compact('items'));
    }
}
