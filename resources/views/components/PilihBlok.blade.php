<div id="class-selection" class="w-full">
    <div class="w-full">
        <div class="flex flex-col gap-2">
            @foreach($bloks as $blok)
                <button onclick="selectClass('{{ $blok }}')" class="class-btn">{{ $blok }}</button>
            @endforeach
        </div>
    </div>
</div>
