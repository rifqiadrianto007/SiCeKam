<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiCekam</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            overflow: hidden;
        }
        .gradient {
            background: linear-gradient(135deg, #713fe5 0%, #4361ee 100%);
        }
        .file-input-area {
            transition: all 0.3s ease;
            border: 2px dashed rgba(113, 63, 229, 0.3);
        }
        .file-input-area:hover {
            border-color: rgba(113, 63, 229, 0.6);
            background-color: rgba(113, 63, 229, 0.05);
        }
        ::-webkit-scrollbar {
            display: none;
        }
        .content-container {
            height: calc(100vh - 180px);
            overflow-y: auto;
        }
        #camera-preview {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
        #camera-container {
            display: none;
            position: relative;
            width: 100%;
            height: 300px;
            background: black;
            border-radius: 0.5rem;
            overflow: hidden;
        }
    </style>
</head>
<body class="h-full bg-gray-50 flex flex-col">
    <div class="bg-white shadow-sm py-4 px-6">
        <div class="flex items-center justify-between">
            <button onclick="window.history.back()" class="text-gray-600 hover:text-primary flex-shrink-0">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </button>
            <h1 class="text-xl font-bold text-center flex-grow">Scan Jumlah Ayam</h1>
            <div class="w-20 flex-shrink-0"></div>
        </div>
    </div>

    <div class="content-container flex-1 py-10 overflow-auto">
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

            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-4">
                <div class="p-8" id="upload-section">
                    <div class="file-input-area rounded-2xl p-10 text-center cursor-pointer" id="drop-area">
                        <input type="file" id="file-upload" class="hidden" accept="image/*">
                        <label for="file-upload" class="block cursor-pointer">
                            <div class="mx-auto mb-6 w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center">
                                <i class="fas fa-cloud-upload-alt text-primary text-4xl"></i>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Upload Foto</h3>

                            <div class="flex justify-center space-x-4">
                                <button id="open-camera-btn" class="px-6 py-2 rounded-lg border-2 border-primary text-primary text-base font-medium hover:bg-primary hover:text-gray-400 transition">
                                    <i class="fas fa-camera mr-2"></i> Ambil Foto
                                </button>
                                <button onclick="document.getElementById('file-upload').click()" class="px-6 py-2 rounded-lg border-2 border-primary text-primary text-base font-medium hover:bg-primary hover:text-gray-400 transition">
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
                                <button id="remove-btn" onclick="removeImage()" class="absolute top-4 right-4 bg-red-500 hover:bg-red-600 text-white p-2 rounded-full text-sm">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button id="scan-btn" class="w-full gradient text-white font-medium py-3 px-6 rounded-xl hover:opacity-90 transition flex items-center justify-center text-base">
                                <i class="fas fa-search mr-2 text-lg"></i>Scan
                            </button>
                        </div>
                    </div>
                </div>

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
                                                <p class="text-xl font-bold text-gray-900">289</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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

    <script>
        // Variables
        let currentImageRotation = 0;
        let stream = null;
        const fileUpload = document.getElementById('file-upload');
        const dropArea = document.getElementById('drop-area');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');
        const scanBtn = document.getElementById('scan-btn');
        const uploadSection = document.getElementById('upload-section');
        const loadingSection = document.getElementById('loading-section');
        const resultsSection = document.getElementById('results-section');
        const resultImage = document.getElementById('result-image');
        const progressBar = document.getElementById('progress-bar');
        const step2 = document.getElementById('step-2');
        const step2Text = document.getElementById('step-2-text');
        const cameraContainer = document.getElementById('camera-container');
        const cameraPreview = document.getElementById('camera-preview');
        const openCameraBtn = document.getElementById('open-camera-btn');
        const closeCameraBtn = document.getElementById('close-camera-btn');
        const captureBtn = document.getElementById('capture-btn');

        // Open camera
        openCameraBtn.addEventListener('click', async function() {
            try {
                dropArea.classList.add('hidden');
                cameraContainer.style.display = 'block';

                stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'environment',
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    },
                    audio: false
                });

                cameraPreview.srcObject = stream;
            } catch (err) {
                console.error("Error accessing camera:", err);
                alert("Tidak dapat mengakses kamera. Pastikan izin kamera telah diberikan.");
                closeCamera();
            }
        });

        // Close camera
        closeCameraBtn.addEventListener('click', closeCamera);

        function closeCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
            cameraPreview.srcObject = null;
            cameraContainer.style.display = 'none';
            dropArea.classList.remove('hidden');
        }

        // Capture photo
        captureBtn.addEventListener('click', function() {
            if (!stream) return;

            const canvas = document.createElement('canvas');
            canvas.width = cameraPreview.videoWidth;
            canvas.height = cameraPreview.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(cameraPreview, 0, 0, canvas.width, canvas.height);

            canvas.toBlob(function(blob) {
                const file = new File([blob], 'kandang-ayam.jpg', { type: 'image/jpeg' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileUpload.files = dataTransfer.files;
                fileUpload.dispatchEvent(new Event('change'));
                closeCamera();
            }, 'image/jpeg', 0.9);
        });

        // Handle file selection
        fileUpload.addEventListener('change', function(e) {
            if (e.target.files.length) {
                const file = e.target.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    dropArea.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Remove image
        function removeImage() {
            fileUpload.value = '';
            previewContainer.classList.add('hidden');
            dropArea.classList.remove('hidden');
        }

        // Rotate image
        function rotateImage() {
            currentImageRotation = (currentImageRotation + 90) % 360;
            imagePreview.style.transform = `rotate(${currentImageRotation}deg)`;
        }

        // Process image
        scanBtn.addEventListener('click', function() {
            uploadSection.classList.add('hidden');
            loadingSection.classList.remove('hidden');
            progressBar.style.width = '50%';

            setTimeout(() => {
                step2.classList.remove('bg-gray-200', 'text-gray-500');
                step2.classList.add('gradient', 'text-white');
                step2Text.classList.remove('text-gray-500');
                step2Text.classList.add('text-primary');
                progressBar.style.width = '100%';

                loadingSection.classList.add('hidden');
                resultsSection.classList.remove('hidden');
                resultImage.src = imagePreview.src;
            }, 2000);
        });

        // Reset process
        function resetProcess() {
            resultsSection.classList.add('hidden');
            uploadSection.classList.remove('hidden');
            dropArea.classList.remove('hidden');
            previewContainer.classList.add('hidden');
            progressBar.style.width = '0%';
            step2.classList.add('bg-gray-200', 'text-gray-500');
            step2.classList.remove('gradient', 'text-white');
            step2Text.classList.add('text-gray-500');
            step2Text.classList.remove('text-primary');
            fileUpload.value = '';
            currentImageRotation = 0;
        }

        // Drag and drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.add('border-primary', 'bg-indigo-50'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.remove('border-primary', 'bg-indigo-50'), false);
        });

        dropArea.addEventListener('drop', function(e) {
            const files = e.dataTransfer.files;
            if (files.length && files[0].type.match('image.*')) {
                fileUpload.files = files;
                fileUpload.dispatchEvent(new Event('change'));
            }
        });
    </script>
</body>
</html>
