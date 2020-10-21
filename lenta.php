<?php
    require_once("lib/ImagesTakerFromDB.php");

    $imagesStoringTB = "store_posters_for_the_film";
    $filmDataStoringTB = "film_data";
    $imagesTakerDBObj = new ImagesTakerFromDB($imagesStoringTB);
    $filmDataTakerDBObj = new ImagesTakerFromDB($filmDataStoringTB);

    $allImages = $imagesTakerDBObj->takeAllImagesFromDB();
    $allFilmData = $filmDataTakerDBObj->takeAllImagesFromDB();
    $user_name = $_SESSION["User_name"];

    $i = 0;



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="wrap">
        <?php
            foreach ($allImages as $img){
                $full_path = $img["path"]."/".$img["name"].".".$img["extension"];
                echo"<img class='picture' src='$full_path' width='10%'>";
                $film_name = $allFilmData[$i]["film_name"];
                $film_producer = $allFilmData[$i]["producer"];
                $film_actor = $allFilmData[$i]["actor"];
                $film_genre = $allFilmData[$i]["genre"];
                echo "<h4>Name: $film_name</h4>";
                echo "<h4>Producer: <a href=''>$film_producer</a></h4>";
                echo "<h4>Actor: <a href=''>$film_actor</a></h4>";
                echo "<h4>Genre: <a href=''>$film_genre</a></h4>";
                $i++;
            }
        ?>
    </div>
    <a href="upload_film.php">Upload</a>
</body>
</html>


