@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if(Route::is('product.edit'))
                    <form method="POST" action="{{route('product.update', $entry->id)}}" enctype="multipart/form-data">
                    @method('PUT')
                @else
                    <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                @endif
                    @csrf
                    <div class="container-fluid">
                        <div class="card">
                            @include('form-elements.card-header')
                            <div class="card-body">
                                <div class="row">
                                    @include('form-elements.errors')
                                    <div class="col-12">
                                        @include('form-elements.input-text', ['label' => 'Nazwa produktu', 'name' => 'name', 'value' => $entry->name])
                                        @include('form-elements.input-text', ['label' => 'Cena', 'name' => 'price', 'value' => $entry->price])
                                        @include('form-elements.input-text', ['label' => 'Cena promocyjna', 'name' => 'price_promo', 'value' => $entry->price_promo])
                                        @include('form-elements.input-file', ['label' => 'Zdjęcie', 'sublabel' => '(wymiary: '.$thumbwidth.'px / '.$thumbheight.'px)', 'name' => 'photo'])
                                        @include('form-elements.textarea', ['label' => 'Opis produktu', 'name' => 'description', 'value' => $entry->description, 'rows' => 11])
                                    </div>
                                </div>
                                @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz produkt'])
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
