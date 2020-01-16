@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-body">
                    <a href="{{route('product.index')}}" class="btn btn-primary">Zobacz katalog</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
