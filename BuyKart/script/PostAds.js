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





 
 document.addEventListener("DOMContentLoaded", function () {
    // Check if the popup should be shown
    if (sessionStorage.getItem("showPopup") === "true") {
        document.getElementById("popup").style.display = "block";
        document.getElementById("overlay").style.display = "block";
        sessionStorage.removeItem("showPopup"); // Remove the flag after showing
    }
});
// Function to close the popup
function closePopup() {
    document.getElementById("popup").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

