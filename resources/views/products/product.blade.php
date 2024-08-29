@extends('outlay.app')


@section('page_content')
    <div class=" p-7 h-full w-full flex flex-col items-center bg-blue-200">
        <h1>View Product</h1>
            
        @livewire('product-options-filter', ['category' => $category, 'slug' => $slug])
      
    </div>   
@endsection