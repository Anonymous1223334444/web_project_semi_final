<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Player</title>
</head>
<body>

    <style>
        <?php include '../../../public/css/VideoPlayer.css' ?> 
    </style>
    <div class="container">
        <div class="main-video-container">
            <video src="../../../public/videos/01 - Welcome.mp4" loop controls class="main-video" autoplay="true"></video>
            <h3 class="main-vid-title">Welcome</h3>
        </div>

        <div class="video-list-container">
            <div class="list active">
                <video src="../../../public/videos/01 - Welcome.mp4" class="list-video"></video>
                <h3 class="list-title">Welcome</h3>
            </div>
            
            <div class="list">
                <video src="../../../public/videos/02 - What you should know.mp4" class="list-video"></video>
                <h3 class="list-title">What you should know</h3>
            </div>

            <div class="list">
                <video src="../../../public/videos/03 - Using the exercise files.mp4" class="list-video"></video>
                <h3 class="list-title">Using the exercise files</h3>
            </div>

            <div class="list">
                <video src="../../../public/videos/04 - Explaining challenges.mp4" class="list-video"></video>
                <h3 class="list-title">Explaining challenges</h3>
            </div>

            <div class="list doc" data-doc="http://localhost/web_dev_3/pages/content/course1/document.php">
                <video src="../../../public/pdf/Andre_Michel_Ibrahima_Sarr3.pdf" class="list-video"></video>
                <h3 class="list-title">Document 1</h3>
            </div>
        </div>
    </div>



    <script>
        <?php include '../../../public/js/VideoPlayer.js' ?> 
        <?php include '../../../public/js/script.js' ?> 
    </script>

</body>
</html>