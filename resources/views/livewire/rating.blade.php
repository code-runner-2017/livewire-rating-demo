<div>
    <div class="text-sm flex justify-between mt-2">
        <span>Average Rating: </span>
        <span class="text-lg text-white font-extrabold rounded-md bg-blue-600 px-2">{{ $avgRating }}</span>
    </div>

    <div class="flex items-center mt-0">
        <span class="text-sm">Your rating:</span>
        <div class="flex items-center ml-2">
            @for ($i = 0; $i < $this->rating; $i++)
                <svg wire:click="setRating({{ $i+1 }})" class="w-3 h-3 fill-current text-yellow-600"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z">
                    </path>
                </svg>
            @endfor

            @for ($i = $this->rating; $i < 5; $i++)
                <svg wire:click="setRating({{ $i+1 }})" class="w-3 h-3 fill-current text-gray-400"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z">
                    </path>
                </svg>
            @endfor
        </div>
    </div>
</div>

