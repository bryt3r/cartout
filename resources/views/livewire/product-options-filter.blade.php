<div class="w-full">

    <div class="flex flex-col w-2/3 mx-auto">
        <p class=" w-fit mb-4 border-b border-orange-700"> {{ucwords($this->product->name)}}</p>
        <div class=" flex flex-row justify-center">
            <i class="fa-solid fa-bag-shopping fa-10x"></i>
            {{-- <img src="{{asset('default.jpg')}}" alt=""> --}}
        </div>
        <div class=" text-gray-400 flex flex-col">
            <span>Brand: {{$this->product->brand}}</span>
            <span>Model: {{$this->product->model}}</span>
        </div>
        <div class="bg-gray-200">
            <p>{{$this->product->description}}</p>
        </div>
        
        <div>
            <i>Variants</i>
                <div class=" w-4/5 flex flex-col justify-around items-center content-start">
                    @foreach ($attributeNames as $attributeName)
                    <div class="mt-4">
                        <label for="{{$attributeName}}">{{$attributeName}}</label>
                        <select wire:model="attributeOptions[{{$attributeName}}]" wire:change="updateSelectedOptions('{{$attributeName}}',$event.target.value)" name="{{$attributeName}}" id="{{$attributeName}}">
                            @if (is_array($attributeOptions[$attributeName]) && count(array_unique($attributeOptions[$attributeName])) == 1)
                                <option value="{{$attributeOptions[$attributeName][0]}}">{{$attributeOptions[$attributeName][0]}}</option>
        
                            @elseif (is_array($attributeOptions[$attributeName]))
                                <option value="">Choose a {{$attributeName}}</option>
        
                                @foreach (array_unique($attributeOptions[$attributeName]) as $option)
                                    <option @selected($selectedOptions[$attributeName]??null == $option) value="{{$option}}">{{$option}}</option>  
                                @endforeach
                        @else
                                <option value="{{$attributeOptions[$attributeName]}}">{{$attributeOptions[$attributeName]}}</option>
                            @endif                                                
                        </select>
                    </div>
                    @endforeach
                
                    <button wire:click="resetOptions">reset</button>
                </div>
        </div>
        
        <button class="my-5 py-4 border border-blue-400 bg-purple-700 text-white rounded-lg">Add To Cart <span><i class="fa-solid fa-cart-shopping"></i></span></button>
    
        
    </div>    

</div>
