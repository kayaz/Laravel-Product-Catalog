<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProducts;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index.index', ['products' => Products::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('forms.product',
            [
                'cardtitle' => 'Dodaj produkt',
                'thumbwidth' => Products::IMG_WIDTH,
                'thumbheight' => Products::IMG_HEIGHT
            ])
            ->with('entry', Products::make());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProducts $request)
    {
        Products::create($request->only(
            [
                'name',
                'price',
                'description',
                'slug'
            ]
        ));

//        if ($request->hasFile('plik')) {
//            $news->makeThumb($request->nazwa, $request->file('plik'));
//        }

        return redirect('/')->with('success', 'Nowy produkt dodany');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Products::where('slug', $slug)->firstOrFail();
        return view('index.product', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        //$products->deleteThumb();
        $products->delete();
        return redirect('/')->with('success', 'Produkt usunięty');
    }
}
