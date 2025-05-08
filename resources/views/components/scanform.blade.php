<div class="content-container flex-1 py-10 overflow-auto" id="deteksi-section">
    <div class="max-w-3xl mx-auto">
        <div class="p-4 mb-4">
            <div class="flex items-center justify-between">
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full gradient flex items-center justify-center text-white font-medium text-sm">1</div>
                    <span class="text-xs mt-1 font-medium text-primary">Upload</span>
                </div>
                <div class="flex-1 mx-2">
                    <div class="h-1 w-full bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full gradient w-0 transition-all duration-500" id="progress-bar"></div>
                    </div>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-medium text-sm" id="step-2">2</div>
                    <span class="text-xs mt-1 font-medium text-gray-500" id="step-2-text">Hasil</span>
                </div>
            </div>
        </div>

        <div id="camera-container" class="mb-4">
            <video id="camera-preview" autoplay playsinline></video>
            <div class="absolute bottom-4 left-0 right-0 flex justify-center">
                <button id="capture-btn" class="rounded-full bg-white border-4 border-primary flex items-center justify-center">
                    <div class="w-10 h-10 rounded-full bg-primary"></div>
                </button>
                <button id="close-camera-btn" class="absolute right-4 top-2 bg-red-500 text-white p-2 rounded-full">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

{{-- BAGIAN AI KEBAWAH PENTING --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-4">
            <form id="scan-form" action="{{ route('scan.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-8" id="upload-section">
                    <div class="file-input-area rounded-2xl p-10 text-center cursor-pointer" id="drop-area">
                        <input type="file" name="image" id="file-upload" class="hidden" accept="image/*" required>
                        <label for="file-upload" class="block cursor-pointer">
                            <div class="mx-auto mb-6 w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center">
                                <i class="fas fa-cloud-upload-alt text-primary text-4xl"></i>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Upload Foto</h3>

                            <div class="flex justify-center space-x-4">
                                <button type="button" id="open-camera-btn" class="px-6 py-2 rounded-lg border-2 border-primary text-primary text-base font-medium hover:bg-primary hover:text-gray-400 transition">
                                    <i class="fas fa-camera mr-2"></i> Ambil Foto
                                </button>
                                <button type="button" onclick="document.getElementById('file-upload').click()" class="px-6 py-2 rounded-lg border-2 border-primary text-primary text-base font-medium hover:bg-primary hover:text-gray-400 transition">
                                    <i class="fas fa-folder-open mr-2"></i> Pilih dari Galeri
                                </button>
                            </div>
                        </label>
                    </div>

                    <div id="preview-container" class="hidden mt-6">
                        <h4 class="text-lg font-medium text-gray-800 mb-4">Pratinjau Foto</h4>

                        <div class="bg-gray-100 rounded-xl p-2">
                            <div class="relative rounded-lg overflow-hidden">
                                <img id="image-preview" class="w-full h-auto max-h-96 object-contain" src="#" alt="Preview">
                                <button id="remove-btn" type="button" onclick="removeImage()" class="absolute top-4 right-4 bg-red-500 hover:bg-red-600 text-white p-2 rounded-full text-sm">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="button" id="scan-btn" class="w-full gradient text-white font-medium py-3 px-6 rounded-xl hover:opacity-90 transition flex items-center justify-center text-base">
                                <i class="fas fa-search mr-2 text-lg"></i>Scan
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div id="loading-section" class="hidden p-6 text-center">
                <div class="mx-auto w-12 h-12 border-4 border-gray-200 border-t-primary rounded-full animate-spin mb-4"></div>
                <h3 class="text-md font-medium text-gray-800 mb-1">Memproses Foto</h3>
                <p class="text-xs text-gray-500">Sistem sedang menganalisis dan menghitung ayam...</p>
            </div>

            <div id="results-section" class="hidden p-4">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="w-full md:w-1/2">
                        <div class="bg-gray-100 rounded-lg p-1">
                            <div class="relative rounded overflow-hidden">
                                <img id="result-image" class="w-full h-auto max-h-64 object-contain" src="#" alt="Processed Image">
                                <div class="absolute top-2 right-2 bg-primary text-white text-xs py-0.5 px-2 rounded-full font-medium">
                                    Processed
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Hasil Analisis</h3>
                        <div class="space-y-3">
                            <div class="bg-indigo-50 p-3 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-primary bg-opacity-20 flex items-center justify-center mr-2">
                                            <i class="fas fa-hashtag text-primary text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Jumlah Ayam Terdeteksi</p>
                                            <p id="jumlah-ayam" class="text-xl font-bold text-gray-900">0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
{{-- SAMPAI SINI --}}

                            <button onclick="resetProcess()" class="w-full py-2 px-4 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center justify-center text-sm font-medium">
                                <i class="fas fa-redo mr-2"></i> Scan Foto Baru
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="bg-indigo-50 rounded-xl p-4 mb-4">
            <h3 class="text-md font-semibold text-gray-800 mb-2 flex items-center">
                <i class="fas fa-lightbulb text-yellow-500 mr-2"></i> Tips untuk Hasil Terbaik
            </h3>
            <div class="grid grid-cols-1 gap-3">
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center mr-2 mt-0.5">
                        <i class="fas fa-sun text-primary text-xs"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-800">Pencahayaan yang Baik</p>
                        <p class="text-xs text-gray-600">Pastikan foto diambil dengan pencahayaan yang cukup</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center mr-2 mt-0.5">
                        <i class="fas fa-expand-arrows-alt text-primary text-xs"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-800">Jarak yang Tepat</p>
                        <p class="text-xs text-gray-600">Ambil foto dari sudut yang mencakup seluruh kandang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
