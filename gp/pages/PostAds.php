<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post an Ad</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="file"] {
            width: 50%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }


        textarea {
            resize: vertical;
        }

        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .preview-container {
            margin-top: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .preview-container img {
            max-width: 100px;
            max-height: 100px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Post an Ad</h1>
        <form action="/submit-ad" method="POST" enctype="multipart/form-data">
            <label for="product-name">Product Name</label>
            <input type="text" id="product-name" name="product-name" placeholder="Enter product name" required>

            <label for="title">Ad Title</label>
            <input type="text" id="title" name="title" placeholder="Enter ad title" required>

            <label for="photos">Photo 1 (Required)</label>
            <input type="file" id="photos" name="photos" accept="image/*" required>
            <div class="preview-container" id="preview-container"></div>

            <label for="photos">Photo 2 (Optional)</label>
            <input type="file" id="photos" name="photos" accept="image/*">
            <div class="preview-container" id="preview-container"></div>

            <label for="photos">Photo 3 (Optional)</label>
            <input type="file" id="photos" name="photos" accept="image/*">
            <div class="preview-container" id="preview-container"></div>

            <label for="address">Address</label>
            <textarea id="address" name="address" placeholder="Enter your address" rows="4" required></textarea>

            <button type="submit">Submit Ad</button>
        </form>
    </div>

    <script>
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
    </script>
</body>

</html>