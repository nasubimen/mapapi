<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Storage;
use JD\Cloudder\Facades\Cloudder;

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
            'name.*' => 'nullable|required',
            'address.*' => 'nullable|required',
        ]);

        $image_path = [];
        $publicId = [];
        $longUrl = [];
        if ($image = $request->file('image')) {
            foreach ($request->file('image') as $index => $file) {
                $image_path[$index] = $file->getRealPath();
                Cloudder::upload($image_path[$index], null);
                $publicId[$index] = Cloudder::getPublicId();
                $longUrl[$index] = Cloudder::secureShow($publicId[$index], [
                    'width'     => 600,
                    'height'    => 450,
                ]);
            }
        }

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
                $item->public_id = $publicId[$index] ?? null;
                $item->image_pass = $longUrl[$index] ?? null;
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
        // 商品一覧取得
        $item = Address::all()->find($id);
        return view('admin.edit', compact('item'));
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
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);
        // 商品一覧取得
        $item = Address::all()->find($id);
        // dd($item);

        $item->name = $request->input('name');
        $item->address = $request->input('address');
        $item->url = $request->input('url');
        $item->type = $request->input('type');
        $item->detail = $request->input('detail');
        $item->save();

        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Address::find($id);
        Cloudder::destroyImage($item->public_id);
        Address::destroy($id);
        return redirect()->route('admin.index');
    }
}
