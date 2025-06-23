from flask import Flask, request, jsonify
from flask_cors import CORS
from ultralytics import YOLO
import cv2
import numpy as np
import os
import shutil
import time

app = Flask(__name__)
CORS(app, origins=["http://127.0.0.1:8000", "http://localhost:8000"])

model = YOLO("D:/Coding/Project/AI SiCekam/AI Hitung/best.pt")

@app.route('/predict', methods=['POST'])
def predict():
    if 'image' not in request.files:
        return jsonify({'success': False, 'error': 'No image provided'}), 400

    file = request.files['image']
    npimg = np.frombuffer(file.read(), np.uint8)
    img = cv2.imdecode(npimg, cv2.IMREAD_COLOR)

    timestamp = str(int(time.time()))
    results = model.predict(
        img,
        # conf=0.2,
        project='output_prediksi',
        name=f"scan_{timestamp}",
        save=True
    )

    output_dir_yolo = results[0].save_dir
    original_image_name = os.path.basename(results[0].path)
    yolo_output_path = os.path.join(output_dir_yolo, original_image_name)

    # Tujuan ke folder Laravel
    laravel_output_dir = 'D:/Coding/laragon/www/SiCekam/storage/app/public/scan'
    os.makedirs(laravel_output_dir, exist_ok=True)

    laravel_file_path = os.path.join(laravel_output_dir, f"scan_{timestamp}.png")

    shutil.copyfile(yolo_output_path, laravel_file_path)

    laravel_file_url = f"/storage/scan/scan_{timestamp}.png"

    detections = results[0].tojson()

    return jsonify({
        'success': True,
        'results': detections,
        'image': laravel_file_url
    })

if __name__ == '__main__':
    app.run(debug=True, port=5000)
