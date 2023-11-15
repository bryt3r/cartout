@extends('outlay.app')


@section('page_content')
    <div class=" p-7 h-full w-full bg-orange-200">
        @if (count($products_group) < 1)
        <div> No Products </div> 
        @else
            @foreach ($products_group as $group => $products)
            <div class="flex flex-col w-full ">
                <p class=" mb-4 border-b border-orange-700"> {{ucwords($group)}}</p>
                <div class=" w-full p-1 mb-8  mx-auto flex flex-row flex-wrap  items-center content-start">
                    @foreach ($products as $product)
                        <div class=" flex flex-col justify-around md:h-[20vw] sm:h-[40vw] h-[90vw] md:w-[20vw] sm:w-[40vw] w-11/12 p-3 mx-2 mb-8 rounded-lg border border-gray-400 shadow-xl cursor-pointer" 
                        onclick="location.href='{{route('product.show', ['category' => $product->product_category_name, 'slug' => $product->slug])}}';">
                            <div class=" flex flex-row justify-center">
                                <i class="fa-solid fa-cart-shopping fa-5x"></i>
                                {{-- <img src="{{asset('default.jpg')}}" alt=""> --}}
                            </div>
                            <p>{{Str::limit($product->name, 40)}}</p>
                        </div>
                    @endforeach
                </div>
                </div> 
            @endforeach
            
        @endif
    </div>   
@endsection