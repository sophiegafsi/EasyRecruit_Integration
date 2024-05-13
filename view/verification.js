
navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
        document.getElementById('video').srcObject = stream;
    })
    .catch(err => {
        console.error("Error accessing the webcam", err);
    });



document.getElementById('capture').addEventListener('click', function() {
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const video = document.getElementById('video');

    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    
    // Stop the video stream
    video.srcObject.getTracks().forEach(track => track.stop());
    video.srcObject = null;

    // Convert canvas to Blob
    canvas.toBlob(function(blob) {
        window.capturedImageBlob = blob;  // Save the Blob globally or pass it to the verification function
    }, 'image/jpeg');
});

document.getElementById('verify').addEventListener('click', async function() {
    const uploadedImage = document.getElementById('uploadedImage').files[0];
    const capturedImageBlob = window.capturedImageBlob;

    if (!uploadedImage || !capturedImageBlob) {
        alert('Both an uploaded image and a captured image are required for verification.');
        return;
    }

    try {
        // Load face-api models
        await faceapi.nets.ssdMobilenetv1.loadFromUri('../view/models');
        await faceapi.nets.faceLandmark68Net.loadFromUri('../view/models');
        await faceapi.nets.faceRecognitionNet.loadFromUri('../view/models');

        // Convert Blob to HTMLImageElement for both images
        const img1 = await faceapi.bufferToImage(uploadedImage);
        const img2 = await faceapi.bufferToImage(capturedImageBlob);

        // Detect faces with descriptors
        const detection1 = await faceapi.detectSingleFace(img1).withFaceLandmarks().withFaceDescriptor();
        const detection2 = await faceapi.detectSingleFace(img2).withFaceLandmarks().withFaceDescriptor();

        if (!detection1 || !detection2) {
            alert('Could not find faces in one or both images.');
            return;
        }

        // Compare descriptors
        let verificationResult = 0;
        const distance = faceapi.euclideanDistance(detection1.descriptor, detection2.descriptor);
        const threshold = 0.6;  // Threshold for considering it a match, adjust as necessary
        if (distance < threshold) {
            verificationResult = 1;
            alert('User verified successfully!');
        } else {
            alert('Failed to verify. Faces do not match.');
        }
        fetch('update_verification_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ verified: verificationResult })
        })
        .then(response => response.json())
    } catch (error) {
        console.error('Error during verification:', error);
        alert('Error during verification. Please try again.');
    }
});
