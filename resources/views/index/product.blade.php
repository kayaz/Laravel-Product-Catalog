@extends('layout')

@section('content')
    <div id="product" class="container">
        <div class="row">
            <div class="col-6">
                <div class="singleproduct-image">
                    <img src="{{asset('uploads/'.$product->photo) }}" alt="{{ $product->name }}">
                </div>
            </div>
            <div class="col-6">
                <div class="singleproduct-content">
                    <h2>{{ $product->name }}</h2>

                    @if ($product->price_promo)
                        <div class="price-promo">{{ $product->price_promo }} zł</div>
                        <div class="price-beforepromo"><s>{{ $product->price }} zł</s></div>
                    @else
                        <div class="price">{{ $product->price }} zł</div>
                    @endif

                    <div class="product-desc">
                        <p>{{ $product->description }}</p>
                    </div>
                    <a href="{{route('product.index')}}" class="btn btn-primary">Wróć do katalogu</a>
                    @auth
                    <a href="{{route('product.edit', $product->id)}}" class="btn btn-success">Edytuj produkt</a>
                    <form method="POST" action="{{route('product.delete', $product->id)}}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger confirm">Usuń produkt</button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
