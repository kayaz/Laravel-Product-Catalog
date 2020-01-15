@extends('layout')

@section('content')
    <div id="product" class="container">
        <div class="row">
            <div class="col-6">
                <div class="singleproduct-image">
                    <img src="https://via.placeholder.com/540x680" alt="{{ $product->name }}">
                </div>
            </div>
            <div class="col-6">
                <div class="singleproduct-content">
                    <h2>{{ $product->name }}</h2>
                    <div class="price">{{ $product->price }} zł</div>

                    <div class="product-desc">
                        <p>{{ $product->description }}</p>
                    </div>
                    <a href="{{route('product.index')}}" class="btn btn-primary">Wróć do katalogu</a>
                    @auth
                    <a href="#" class="btn btn-success">Edytuj produkt</a>
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
