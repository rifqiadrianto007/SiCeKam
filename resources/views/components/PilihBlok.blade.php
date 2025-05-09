<div id="class-selection" class="min-h-screen w-full flex flex-col justify-center items-center p-6 bg-gray-50">
    <h1 class="text-2xl font-bold mb-6">Pilih Kelas Kandang</h1>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 mb-6">
        <!-- Tombol kelas A1 - A10 -->
        <button onclick="selectClass('A1')" class="class-btn">A1</button>
        <button onclick="selectClass('A2')" class="class-btn">A2</button>
        <button onclick="selectClass('A3')" class="class-btn">A3</button>
        <button onclick="selectClass('A4')" class="class-btn">A4</button>
        <button onclick="selectClass('A5')" class="class-btn">A5</button>
        <button onclick="selectClass('A6')" class="class-btn">A6</button>
        <button onclick="selectClass('A7')" class="class-btn">A7</button>
        <button onclick="selectClass('A8')" class="class-btn">A8</button>
        <button onclick="selectClass('A9')" class="class-btn">A9</button>
        <button onclick="selectClass('A10')" class="class-btn">A10</button>
    </div>
    <button id="lanjut-btn"
        class="bg-primary text-indigo-500 font-semibold py-3 px-6 rounded-lg hover:opacity-90 transition disabled:opacity-50"
        disabled>Lanjutkan</button>
</div>
