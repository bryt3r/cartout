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
                <div class="w-full flex flex-col justify-around items-center content-start">
                    @foreach ($product->attributes() as $attribute)
                    <div class="mt-4">
                        <label for="{{$attribute->name}}">{{$attribute->name}}</label>
                        <select name="" id="">
                            <option value="">Choose a {{$attribute->name}}</option>
                            @if (is_array($attributeOptions[$attribute->name]))
                                @foreach (array_unique($attributeOptions[$attribute->name]) as $option)
                                <option value="{{$option}}">{{$option}}</option>  
                                @endforeach
                            @else
                                <option value="{{$attributeOptions[$attribute->name]}}">{{$attributeOptions[$attribute->name]}}</option>
                            @endif                                                
                        </select>
                    </div>
                    @endforeach
                </div>
            </div>
            
        <button class="my-5 py-4 border border-blue-400 bg-purple-700 text-white rounded-lg">Add To Cart <span><i class="fa-solid fa-cart-shopping"></i></span></button>
        </div>      
    </div>   
@endsection