<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passport Scanner</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="./assets/images/favicon.png" type="image/x-icon">
    <style>
        /* Custom styles */
        body {
            background-color: #f0f4f8;
            /* Soft light blue */
            font-family: "Georgia", "Times New Roman", serif;
            /* Classical fonts */
        }

        .card {
            border: none;
            /* Remove card border */
            border-radius: 10px;
            /* Rounded corners */
        }

        .card-body {
            padding: 2rem;
            /* Extra padding for content */
        }

        .card-title {
            color: #333;
            /* Dark gray for better readability */
            margin-bottom: 1.5rem;
            /* Space below title */
            font-family: "Georgia", "Times New Roman", serif;
            /* Classical fonts */
        }

        .form-group label {
            color: #555;
            /* Medium gray for label text */
        }

        .form-control-file {
            padding: 1rem;
            /* Padding for file input */
            background-color: #f7f9fc;
            /* Light background color */
            border-radius: 5px;
            /* Rounded corners */
            font-family: "Georgia", "Times New Roman", serif;
            /* Classical fonts */
        }

        .btn-primary {
            background-color: #007bff;
            /* Primary button color */
            border-color: #007bff;
            /* Button border color */
            padding: 0.3rem 1.5rem;
            /* Button padding */
            font-size: 1rem;
            /* Font size */
            border-radius: 5px;
            /* Rounded corners */
            font-family: "Georgia", "Times New Roman", serif;
            /* Classical fonts */
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Darker blue on hover */
            border-color: #0056b3;
            /* Darker border on hover */
        }

        .google-search {
            margin-top: 1.5rem;
            /* Space above Google search input */
            display: flex;
            /* Align items in a row */
            align-items: center;
            /* Center items vertically */
        }

        .google-search input {
            width: calc(100% - 50px);
            /* Adjust width of input */
            padding: 0.75rem;
            /* Padding for input */
            border: 1px solid #ccc;
            /* Light border */
            border-radius: 5px;
            /* Rounded corners */
            font-size: 1rem;
            /* Font size */
            font-family: "Georgia", "Times New Roman", serif;
            /* Classical fonts */
        }

        .google-search button {
            padding: 0.75rem;
            /* Padding for button */
            background-color: #333;
            /* Dark gray button */
            border: none;
            /* No border */
            color: white;
            /* White text */
            border-radius: 5px;
            /* Rounded corners */
            font-size: 1rem;
            /* Font size */
            margin-left: 5px;
            /* Space between input and button */
            font-family: "Georgia", "Times New Roman", serif;
            /* Classical fonts */
        }

        .google-search button:hover {
            background-color: #555;
            /* Slightly lighter gray on hover */
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="card-title text-center">Upload a Passport to Scan</h1>
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="photo" class="font-weight-bold">Choose a photo:</label>
                                <input type="file" name="photo" id="photo" class="form-control-file" accept="image/*"
                                    required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                        <!-- Google Search Form -->
                        <div class="google-search">
                            <input type="text" id="search-input" placeholder="Sample Indian Passports Here">
                            <button type="submit" onclick="searchGoogle()"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- FontAwesome for search icon -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- JavaScript for Placeholder Animation -->
    <script>
        function searchGoogle() {
            var input = document.getElementById('search-input');
            var query = input.value;
            if (query) {
                window.open('https://www.google.com/search?q=' + encodeURIComponent(query), '_blank');
                input.value = ''; // Clear the input field after search
            }
        }

        function animatePlaceholder() {
            var input = document.getElementById('search-input');
            var placeholderText = "Search For Sample Indian Passports Here";
            var index = 0;
            var intervalTime = 200;

            function updatePlaceholder() {
                if (index <= placeholderText.length) {
                    input.placeholder = placeholderText.slice(0, index) + (index % 2 ? "_" : "");
                    index++;
                    setTimeout(updatePlaceholder, intervalTime);
                } else {
                    index = 0; // Reset index to loop
                    input.placeholder = ""; // Clear placeholder before restarting
                    setTimeout(updatePlaceholder, intervalTime); // Restart animation
                }
            }

            updatePlaceholder();
        }

        window.onload = function () {
            animatePlaceholder();
        };
    </script>
</body>

</html>