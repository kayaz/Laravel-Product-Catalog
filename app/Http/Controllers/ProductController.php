<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index.index', ['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('forms.product', [
                'cardtitle' => 'Dodaj produkt',
                'thumbwidth' => Product::IMG_WIDTH,
                'thumbheight' => Product::IMG_HEIGHT
            ])->with('entry', Product::make());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreProduct $request)
    {
        $product = Product::create($request->only(
            [
                'name',
                'price',
                'price_promo',
                'description',
                'slug'
            ]
        ));

        if ($request->hasFile('photo')) {
            $product->makeThumb($request->name, $request->file('photo'));
        }

        return redirect('/')->with('success', 'Nowy produkt dodany');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $products
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('index.product', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('forms.product', [
            'entry' => $product,
            'cardtitle' => 'Edytuj produkt',
            'thumbwidth' => Product::IMG_WIDTH,
            'thumbheight' => Product::IMG_HEIGHT
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $products
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(StoreProduct $request, Product $products)
    {
        $products->update($request->only(
            [
                'name',
                'price',
                'price_promo',
                'description',
                'slug'
            ]
        ));

        if ($request->hasFile('photo')) {
            $products->makeThumb($request->name, $request->file('photo'));
        }

        return redirect('/')->with('success', 'Produkt zaktualizowany');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $products)
    {
        $products->deleteThumb();
        $products->delete();
        return redirect('/')->with('success', 'Produkt usunięty');
    }
}
