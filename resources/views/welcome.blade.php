@extends('frontend.layout')

@section('content')

<div class="container py-5">
    <div class="row text-center text-white mb-5">
        <div class="col-lg-7 mx-auto">
            <h1 class="display-4">Product List</h1>
        </div>
    </div>
    @foreach($products as $product)
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <!-- List group-->
            <ul class="list-group shadow">
                <!-- list group item-->
                <li class="list-group-item">
                    <!-- Custom content-->
                    <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                        <div class="media-body order-2 order-lg-1">
                            <h5 class="mt-0 font-weight-bold mb-2">{{ $product->name }}</h5>
                            <p class="font-italic text-muted mb-0 small">
                                <ul>{!! $product->description !!}</ul>
                            </p>
                            
                        </div>
                        @if($product->status != 'manual' && @getimagesize($product->image))
                        <img src="{{ $product->image }}" alt="Generic placeholder image" width="200" class="ml-lg-7 order-1 order-lg-2">
                        @else
                        <img src="{{ url('assets/images/macbook.jpg') }}" alt="Generic placeholder image" width="200" class="ml-lg-5 order-1 order-lg-2">
                        @endif
                    </div> <!-- End -->
                </li> <!-- End -->
              
            </ul> <!-- End -->
        </div>
    </div>
    @endforeach
</div>

@endsection
