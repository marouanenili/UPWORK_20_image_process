<html>
<head>
    <style>
        /* styles for the spinner */
        .loading {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .left-side {
            float: left;
            width: 40%;
            text-align: center;
            padding: 50px;
        }

        .right-side {
            float: right;
            width: 40%;
            text-align: center;
            padding: 50px;
        }

        img {
            width: 60%;
            height: auto;
        }

        form {
            text-align: center;
            margin-top: 50px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="left-side">
    <h2>Uploaded Image</h2>
    <img id="original-image" src="" alt="Uploaded Image">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image-input">
        <input type="submit" value="Process">
    </form>
</div>
<div class="right-side">
    <h2>Processed Image</h2>
    <div class="loading">
        <img src="loading.gif" alt="Loading...">
    </div>
    <img id="processed-image" src="" alt="Processed Image">
</div>

<script>
    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault();
        //show spinner
        document.querySelector(".loading").style.display = "block";
        const formData = new FormData();
        formData.append("image", document.querySelector("#image-input").files[0]);
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "process.php", true);
        xhr.onload = function() {
            document.querySelector(".loading").style.display = "none";
            if (this.status === 200) {
                console.log('done')

                document.querySelector("#processed-image").src = "stylized-image.png?"+ new Date().getTime();
            } else {
                document.querySelector("#processed-image").src = "stylized-image.png?"+ new Date().getTime();
                console.error("Image processing failed");
            }
        };
        xhr.send(formData);
    });

    document.querySelector("#image-input").addEventListener("change", function() {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.querySelector("#original-image").src = event.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });
</script>
</body>
</html>
