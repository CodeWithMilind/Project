<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post an Ad</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            width: 80%;
            max-width: 800px;
            margin: 2rem auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 1rem;
            font-size: 1.8rem;
            color: #343a40;
        }

        form {
            display: table;
            width: 100%;
        }

        label {
            display: table-row;
            font-weight: 500;
            color: #495057;
            padding-bottom: 5px;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            display: table-row;
            margin-bottom: 1rem;
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        textarea {
            resize: none;
        }

        button {
            display: table-row;
            width: 100%;
            padding: 10px 15px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
        }

        button:hover {
            background-color: #0056b3;
        }

        .preview-container {
            margin-top: 10px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .preview-container img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-row label,
        .form-row input {
            flex: 1;
        }

    </style>
</head>

<body>
    <div class="container">
        <h1>Post an Ad</h1>
        <form action="/submit-ad" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product-name">Product Name</label>
                <input type="text" id="product-name" name="product-name" placeholder="Enter product name" required>
            </div>

            <div class="form-group">
                <label for="title">Ad Title</label>
                <input type="text" id="title" name="title" placeholder="Enter ad title" required>
            </div>

            <div class="form-group">
                <label for="photos">Photo (Required)</label>
                <input type="file" id="photos" name="photos" accept="image/*" multiple required>
                <div class="preview-container" id="preview-container"></div>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" placeholder="Enter your address" rows="4" required></textarea>
            </div>

            <button type="submit">Submit Ad</button>
        </form>
    </div>

    <script>
        const fileInput = document.getElementById('photos');
        const previewContainer = document.getElementById('preview-container');

        fileInput.addEventListener('change', (event) => {
            previewContainer.innerHTML = ''; // Clear previous previews
            const files = event.target.files;

            Array.from(files).forEach((file) => {
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
