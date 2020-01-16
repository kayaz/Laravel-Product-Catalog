@extends('layout')

@section('content')
    @auth
    <div id="product-admin">
        <a href="{{route('product.create')}}" class="btn btn-success">Dodaj produkt</a>
    </div>
    @endauth
    <div id="products-list" class="container">
        @if (session('success'))
            <div class="alert alert-success border-0 mb-4">
                {{ session('success') }}
                <script>window.setTimeout(function(){$(".alert").fadeTo(500,0).slideUp(500,function(){$(this).remove()})},3000);</script>
            </div>
        @endif
        <div class="row">
            @foreach ($products as $p)
            <div class="col-3">
                <div class="product-item">
                    <div class="product-image">
                        <a href="{{route('product.show', $p->slug)}}">
                            <img src="{{asset('uploads/thumbs/'.$p->photo) }}" alt="{{ $p->name }}">
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="{{route('product.show', $p->slug)}}">{{ $p->name }}</a></h3>
                        @if ($p->price_promo)
                            <div class="price-promo">{{ $p->price_promo }} zł</div>
                            <div class="price-beforepromo"><s>{{ $p->price }} zł</s></div>
                        @else
                            <div class="price">{{ $p->price }} zł</div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
