@extends('layout')

@section('content')
    @auth
    <div id="product-admin">
        <a href="{{route('admin.product.add')}}" class="btn btn-success">Dodaj produkt</a>
    </div>
    @endauth
    <div id="products-list" class="container">
        <div class="row">
            @foreach ($products as $p)
            <div class="col-3">
                <div class="product-item">
                    <div class="product-image">
                        <a href="{{route('catalog.product', $p->slug)}}">
                            <img src="https://via.placeholder.com/255x320" alt="{{ $p->name }}">
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="{{route('catalog.product', $p->slug)}}">{{ $p->name }}</a></h3>
                        <div class="price">{{ $p->price }} zł</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
