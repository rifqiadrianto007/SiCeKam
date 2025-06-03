@vite(['resources/css/app.css'])

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

    .class-btn {
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        background-color: #f3f4f6;
        font-weight: 500;
        transition: all 0.2s;
        width: 100%;
        text-align: center;
        margin-bottom: 0.5rem;
    }

    .class-btn:hover {
        background-color: #e0e7ff;
    }

    .class-btn.selected {
        background-color: #6366f1;
        color: white;
    }

    .split-container {
        display: flex;
        height: calc(100vh - 64px);
    }

    .blok-section {
        flex: 0 0 20%;
        padding: 20px;
        overflow-y: auto;
        background-color: #f8fafc;
        transition: all 0.3s ease;
    }

    .scan-section {
        flex: 0 0 80%;
        padding: 20px;
        overflow-y: auto;
        background-color: white;
        transition: all 0.3s ease;
    }

    .disabled-section {
        opacity: 0.5;
        pointer-events: none;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #1e293b;
    }

    .blok-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #1e293b;
    }

    .status-sehat {
        color: #10b981;
    }

    .status-sakit {
        color: #ef4444;
    }
</style>

@extends('layout.app')

@section('content')
<body class="bg-gray-50 text-gray-800 font-sans scrollbar-hide">
    <div class="bg-white shadow-sm py-4 px-6 sticky top-0 z-10">
        <div class="flex items-center justify-between">
            <button onclick="window.history.back()" class="text-gray-600 hover:text-primary flex-shrink-0">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </button>
            <h1 class="text-xl font-bold text-center flex-grow">Deteksi Kondisi Ayam</h1>
            <div class="w-20 flex-shrink-0"></div>
        </div>
    </div>

    <div class="split-container">
        <div class="blok-section" id="blok-section">
            <h2 class="blok-title">Pilih Blok Kandang</h2>
            <x-PilihBlok :bloks="$bloks" />
        </div>

        <div class="scan-section disabled-section" id="scan-section">
            <h2 class="section-title">Deteksi Kondisi Ayam</h2>
            <x-penyakitform />
        </div>
    </div>

    <script>
        let currentImageRotation = 0;
        let stream = null;
        let selectedClass = null;
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
        const blokSection = document.getElementById('blok-section');
        const scanSection = document.getElementById('scan-section');
        const statusAyam = document.getElementById('status-ayam');

        // Pemilihan kelas
        function selectClass(className) {
            if (selectedClass === className) return;

            selectedClass = className;

            document.querySelectorAll('.class-btn').forEach(btn => {
                btn.classList.remove('selected');
            });

            const clickedBtn = event.currentTarget;
            clickedBtn.classList.add('selected');

            scanSection.classList.remove('disabled-section');
            blokSection.classList.add('disabled-section');

            console.log("Blok yang dipilih:", className);
        }

        // Upload ke API Flask
        document.getElementById('scan-btn').addEventListener('click', uploadToFlaskAPI);

        async function uploadToFlaskAPI() {
            const fileInput = document.getElementById('file-upload');
            if (!fileInput.files.length) {
                alert('Silakan pilih gambar terlebih dahulu.');
                return;
            }

            const file = fileInput.files[0];
            const formData = new FormData();
            formData.append('image', file);
            formData.append('blok', selectedClass);

            try {
                uploadSection.classList.add('hidden');
                loadingSection.classList.remove('hidden');
                progressBar.style.width = '50%';

                const response = await fetch('http://localhost:5001/predict', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();
                console.log('Hasil dari Flask:', data);

                step2.classList.remove('bg-gray-200', 'text-gray-500');
                step2.classList.add('gradient', 'text-white');
                step2Text.classList.remove('text-gray-500');
                step2Text.classList.add('text-primary');
                progressBar.style.width = '100%';

                loadingSection.classList.add('hidden');
                resultsSection.classList.remove('hidden');

                if (data.success) {
                    resultImage.src = data.image;

                    statusAyam.textContent = data.status === 'sakit' ? 'Sakit' : 'Sehat';

                    if (data.status === 'sakit') {
                        statusAyam.classList.add('status-sakit');
                        statusAyam.classList.remove('status-sehat');
                    } else {
                        statusAyam.classList.add('status-sehat');
                        statusAyam.classList.remove('status-sakit');
                    }
                } else {
                    alert('Deteksi gagal: ' + (data.error || 'Unknown error'));
                    resetProcess();
                }
            } catch (error) {
                console.error('Gagal mengirim ke API Flask:', error);
                alert('Terjadi kesalahan saat menghubungi server Flask.');
                resetProcess();
            }
        }

        // Camera
        openCameraBtn.addEventListener('click', async function() {
            try {
                dropArea.classList.add('hidden');
                cameraContainer.style.display = 'block';

                stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'environment',
                        width: {
                            ideal: 1280
                        },
                        height: {
                            ideal: 720
                        }
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

        captureBtn.addEventListener('click', function() {
            if (!stream) return;

            const canvas = document.createElement('canvas');
            canvas.width = cameraPreview.videoWidth;
            canvas.height = cameraPreview.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(cameraPreview, 0, 0, canvas.width, canvas.height);

            canvas.toBlob(function(blob) {
                const file = new File([blob], 'kandang-ayam.jpg', {
                    type: 'image/jpeg'
                });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileUpload.files = dataTransfer.files;
                fileUpload.dispatchEvent(new Event('change'));
                closeCamera();
            }, 'image/jpeg', 0.9);
        });

        // File handle
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

        function removeImage() {
            fileUpload.value = '';
            previewContainer.classList.add('hidden');
            dropArea.classList.remove('hidden');
        }

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
            statusAyam.textContent = '-';
            statusAyam.classList.remove('status-sehat', 'status-sakit');
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
            dropArea.addEventListener(eventName, () => dropArea.classList.add('border-primary', 'bg-indigo-50'),
                false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.remove('border-primary', 'bg-indigo-50'),
                false);
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
@endsection
