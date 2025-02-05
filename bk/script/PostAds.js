// js to preview the uploaded photo on the screen from device 

const photosInput = document.getElementById('photos');
const previewContainer = document.getElementById('preview-container');

photosInput.addEventListener('change', () => {
    previewContainer.innerHTML = ''; // Clear previous previews
    const files = photosInput.files;

    Array.from(files).forEach(file => {
        const reader = new FileReader();

        reader.onload = (e) => {
            const img = document.createElement('img');
            img.src = e.target.result;
            previewContainer.appendChild(img);
        };

        reader.readAsDataURL(file);
    });
});