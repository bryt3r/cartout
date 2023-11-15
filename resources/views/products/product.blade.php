@extends('outlay.app')


@section('page_content')
    <div class=" p-7 h-full w-full flex flex-col items-center bg-blue-200">
        <h1>View Product</h1>
        <div class="flex flex-col w-2/3 ">
            <p class=" w-fit mb-4 border-b border-orange-700"> {{ucwords($product->name)}}</p>
            <div class=" flex flex-row justify-center">
                <i class="fa-solid fa-bag-shopping fa-10x"></i>
                {{-- <img src="{{asset('default.jpg')}}" alt=""> --}}
            </div>
            <div class=" text-gray-400 flex flex-col">
                <span>Brand: {{$product->brand}}</span>
                <span>Model: {{$product->model}}</span>
            </div>
            <div class="bg-gray-200">
                <p>{{$product->description}}</p>
            </div>
            <div>
                <i>Variants</i>
                <div class="w-full flex flex-row flex-wrap items-center content-start">
                    @foreach ($product->skus as $variant)
                    <div class="bg-blue-500 p-2 mx-2 cursor-pointer">variant</div>  
                    @endforeach
                </div>
            </div>
            
        <button class="my-5 py-4 border border-blue-400 bg-purple-700 text-white rounded-lg">Add To Cart <span><i class="fa-solid fa-cart-shopping"></i></span></button>
        </div>      
    </div>   
@endsection