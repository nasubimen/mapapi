<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Address::all();
        // dd($item);

        return view('admin.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('テスト');
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        // dd($request->name,$request->address,$request->type,$request->detail);

        $names = $request->input('name');
        $addresses = $request->input('address');
        $url = $request->input('url');
        $types = $request->input('type');
        $details = $request->input('detail');
        // 送信されたデータの件数分ループ処理を行う
        foreach ($names as $index => $name) {
            if (!empty($name && $addresses[$index])) {
                $item = new Address();
                $item->name = $name;
                $item->address = $addresses[$index];
                $item->url = $url[$index];
                $item->type = $types[$index];
                $item->detail = $details[$index];
                $item->save();
            }
        }


        return redirect()->route('admin.index')->with('success', '追加しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Address::all()->find($id);

        return view('admin.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
