<?php
    require_once("lib/ImagesMiddleStoring.php");
    require_once("lib/FilmAdder.php");

    $imagesStoringDir = "posters";
    $imagesStoringTB = "store_posters_for_the_film";
    $filmNameStoringTB = "film_data";
    $user_name = $_SESSION["User_name"];

    $imagesMSObj = new ImagesMiddleStoring();
    $imagesAddObj = new FilmAdder($imagesStoringTB);
    $filmDataAddObj = new FilmAdder($filmNameStoringTB);

    if (!empty($_FILES['images'])&&!empty($_POST['film_name'])&&!empty($_POST['producer'])&&!empty($_POST['actor'])&&!empty($_POST['genre'])){
        if(!file_exists($imagesStoringDir)) {
            mkdir($imagesStoringDir);
        }

        $images = ($imagesMSObj->reArrayFiles($_FILES['images']));

        foreach ($images as $file) {
            $filename = date_create_from_format('U.u', microtime(true))->format('Y_m_d_H_i_s_u');
            $ary = explode('.', $file['name']);
            $extension = end($ary);

            $imagesAddObj->addImagesIntoDir($file,$filename,$extension);
            if (file_exists($imagesStoringDir."/".$filename.".".$extension)){
                $imagesAddObj->addPosterIntoDB($filename,$extension);
                $filmDataAddObj->addNameOfTheFilm($_POST['film_name'],$_POST['producer'],$_POST['actor'],$_POST['genre']);

            }
        }
    }
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
            <form class="box" method="post" enctype="multipart/form-data">
                <input type="file" name="images[]" multiple>
                <label>Film name:<input type="text" name="film_name"></label>
                <label>Producer:<input type="text" name="producer"></label>
                <label>Actor:<input type="text" name="actor"></label>
                <label>Genre:<input type="text" name="genre"></label>
                <input type="submit" name="submit_button">
            </form>
            <a href='lenta.php'>Lenta</a>
        </body>
</html>
