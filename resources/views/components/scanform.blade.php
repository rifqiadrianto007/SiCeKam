<div class="content-container flex-1 py-10 overflow-auto" id="deteksi-section">
    <div class="max-w-3xl mx-auto">
        <div class="p-4 mb-4">
            <div class="flex items-center justify-between">
                <div class="flex flex-col items-center">
                    <div
                        class="w-8 h-8 rounded-full gradient flex items-center justify-center text-white font-medium text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                    </div>
                    <span class="text-xs mt-1 font-medium text-primary">Upload</span>
                </div>
                <div class="flex-1 mx-2">
                    <div class="h-1 w-full bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full gradient w-0 transition-all duration-500" id="progress-bar"></div>
                    </div>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-medium text-sm"
                        id="step-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <span class="text-xs mt-1 font-medium text-gray-500" id="step-2-text">Hasil</span>
                </div>
            </div>
        </div>

        <div id="camera-container" class="mb-4">
            <video id="camera-preview" autoplay playsinline></video>
            <div class="absolute bottom-4 left-0 right-0 flex justify-center">
                <button id="capture-btn"
                    class="rounded-full bg-white border-4 border-primary flex items-center justify-center">
                    <div class="w-10 h-10 rounded-full bg-primary"></div>
                </button>
                <button id="close-camera-btn" class="absolute right-4 top-2 bg-red-500 text-white p-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-4">
            <form id="scan-form" action="{{ route('scan.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-8" id="upload-section">
                    <div class="file-input-area rounded-2xl p-10 text-center cursor-pointer" id="drop-area">
                        <input type="file" name="image" id="file-upload" class="hidden" accept="image/*" required>
                        <label for="file-upload" class="block cursor-pointer">
                            <div
                                class="mx-auto mb-6 w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Upload Foto</h3>

                            <div class="flex justify-center space-x-4">
                                <button type="button" id="open-camera-btn"
                                    class="px-6 py-2 rounded-lg border-2 border-primary text-primary text-base font-medium hover:bg-primary hover:text-gray-400 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg> Ambil Foto
                                </button>
                                <button type="button" onclick="document.getElementById('file-upload').click()"
                                    class="px-6 py-2 rounded-lg border-2 border-primary text-primary text-base font-medium hover:bg-primary hover:text-gray-400 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                    </svg> Pilih dari Galeri
                                </button>
                            </div>
                        </label>
                    </div>

                    <div id="preview-container" class="hidden mt-6">
                        <h4 class="text-lg font-medium text-gray-800 mb-4">Pratinjau Foto</h4>

                        <div class="bg-gray-100 rounded-xl p-2">
                            <div class="relative rounded-lg overflow-hidden">
                                <img id="image-preview" class="w-full h-auto max-h-96 object-contain" src="#"
                                    alt="Preview">
                                <button id="remove-btn" type="button" onclick="removeImage()"
                                    class="absolute top-4 right-4 bg-red-500 hover:bg-red-600 text-white p-2 rounded-full text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="button" id="scan-btn"
                                class="w-full gradient text-white font-medium py-3 px-6 rounded-xl hover:opacity-90 transition flex items-center justify-center text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                                </svg> Scan
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div id="loading-section" class="hidden p-6 text-center">
                <div class="mx-auto w-12 h-12 border-4 border-gray-200 border-t-primary rounded-full animate-spin mb-4">
                </div>
                <h3 class="text-md font-medium text-gray-800 mb-1">Memproses Foto</h3>
                <p class="text-xs text-gray-500">Sistem sedang menganalisis dan menghitung ayam...</p>
            </div>

            <div id="results-section" class="hidden p-4">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="w-full md:w-1/2">
                        <div class="bg-gray-100 rounded-lg p-1">
                            <div class="relative rounded overflow-hidden">
                                <img id="result-image" class="w-full h-auto max-h-64 object-contain" src="#"
                                    alt="Processed Image">
                                <div
                                    class="absolute top-2 right-2 bg-primary text-white text-xs py-0.5 px-2 rounded-full font-medium">
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
                                        <div
                                            class="w-8 h-8 rounded-full bg-primary bg-opacity-20 flex items-center justify-center mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Jumlah Ayam Terdeteksi</p>
                                            <p id="jumlah-ayam" class="text-xl font-bold text-gray-900">0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button onclick="resetProcess()"
                                class="w-full py-2 px-4 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center justify-center text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg> Scan Foto Baru
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="bg-indigo-50 rounded-xl p-4 mb-4">
            <h3 class="text-md font-semibold text-gray-800 mb-2 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                </svg> Tips untuk Hasil Terbaik
            </h3>
            <div class="grid grid-cols-1 gap-3">
                <div class="flex items-start">
                    <div
                        class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center mr-2 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-800">Pencahayaan yang Baik</p>
                        <p class="text-xs text-gray-600">Pastikan foto diambil dengan pencahayaan yang cukup</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div
                        class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center mr-2 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 22V12h6v10" />
                        </svg>
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
