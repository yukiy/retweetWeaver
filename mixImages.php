<?php

function wovenMix($baseImg, $newImg){
    $width = imageSx($baseImg);
    $height = imageSy($baseImg);
    $outImg = ImageCreateTrueColor($width, $height);
    $barW = $width/8;

    $direction = file_get_contents(__DIR__ . "/direction.txt");

    if($direction == 0){
        addStringToFile(__DIR__ . "/direction.txt", "1");
        for($y = 0; $y < $height; $y++){
            for($x = 0; $x<$width; $x++){
                if($barW*0 <= $x && $x < $barW*1
                    || $barW*2 <= $x && $x < $barW*3
                    || $barW*4 <= $x && $x < $barW*5
                    || $barW*6 <= $x && $x < $barW*7
                ){
                    if($barW*0 <= $y && $y < $barW*1
                        || $barW*2 <= $y && $y < $barW*3
                        || $barW*4 <= $y && $y < $barW*5
                        || $barW*6 <= $y && $y < $barW*7
                    ){
                        $col = imagecolorat($newImg, $x, $y);
                    }else{
                        $col = imagecolorat($baseImg, $x, $y);
                    }
                }else{
                    $col = imagecolorat($baseImg, $x, $y);
                }
                imageSetPixel($outImg, $x, $y, $col);
            }
        }
    }else if($direction == 1){
        addStringToFile(__DIR__ . "/direction.txt", "2");
        for($y = 0; $y < $height; $y++){
            for($x = 0; $x<$width; $x++){
                if($barW*1 <= $x && $x < $barW*2
                    || $barW*3 <= $x && $x < $barW*4
                    || $barW*5 <= $x && $x < $barW*6
                    || $barW*7 <= $x && $x < $barW*8
                ){
                    if($barW*1 <= $y && $y < $barW*2
                        || $barW*3 <= $y && $y < $barW*4
                        || $barW*5 <= $y && $y < $barW*6
                        || $barW*7 <= $y && $y < $barW*8
                    ){
                        $col = imagecolorat($newImg, $x, $y);
                    }else{
                        $col = imagecolorat($baseImg, $x, $y);
                    }
                }else{
                    $col = imagecolorat($baseImg, $x, $y);
                }
                imageSetPixel($outImg, $x, $y, $col);
            }
        }
    }else if($direction == 2){
        addStringToFile(__DIR__ . "/direction.txt", "3");
        for($y = 0; $y < $height; $y++){
            for($x = 0; $x<$width; $x++){
                if($barW*1 <= $x && $x < $barW*2
                    || $barW*3 <= $x && $x < $barW*4
                    || $barW*5 <= $x && $x < $barW*6
                    || $barW*7 <= $x && $x < $barW*8
                ){
                    if($barW*0 <= $y && $y < $barW*1
                        || $barW*2 <= $y && $y < $barW*3
                        || $barW*4 <= $y && $y < $barW*5
                        || $barW*6 <= $y && $y < $barW*7
                    ){
                        $col = imagecolorat($newImg, $x, $y);
                    }else{
                        $col = imagecolorat($baseImg, $x, $y);
                    }
                }else{
                    $col = imagecolorat($baseImg, $x, $y);
                }
                imageSetPixel($outImg, $x, $y, $col);
            }
        }
    }else if($direction == 3){
        addStringToFile(__DIR__ . "/direction.txt", "0");
        for($y = 0; $y < $height; $y++){
            for($x = 0; $x<$width; $x++){
                if($barW*0 <= $x && $x < $barW*1
                    || $barW*2 <= $x && $x < $barW*3
                    || $barW*4 <= $x && $x < $barW*5
                    || $barW*6 <= $x && $x < $barW*7
                ){
                    if($barW*1 <= $y && $y < $barW*2
                        || $barW*3 <= $y && $y < $barW*4
                        || $barW*5 <= $y && $y < $barW*6
                        || $barW*7 <= $y && $y < $barW*8
                    ){
                        $col = imagecolorat($newImg, $x, $y);
                    }else{
                        $col = imagecolorat($baseImg, $x, $y);
                    }
                }else{
                    $col = imagecolorat($baseImg, $x, $y);
                }
                imageSetPixel($outImg, $x, $y, $col);
            }
        }
    }
    return $outImg;
}


function stripeMix($baseImg, $newImg){
    $width = imageSx($baseImg);
    $height = imageSy($baseImg);
    $outImg = ImageCreateTrueColor($width, $height);
    $barW = $width/8;

    $direction = file_get_contents(__DIR__ . "/direction.txt");

    if($direction == 0){
        addStringToFile(__DIR__ . "/direction.txt", "1");
        for($y = 0; $y < $height; $y++){
            for($x = 0; $x<$width; $x++){
                if($barW*0 <= $x && $x < $barW*1
                    || $barW*2 <= $x && $x < $barW*3
                    || $barW*4 <= $x && $x < $barW*5
                    || $barW*6 <= $x && $x < $barW*7
                ){
                    $col = imagecolorat($baseImg, $x, $y);
                }else{
                    $col =  imagecolorat($newImg, $x, $y);
                }
                imageSetPixel($outImg, $x, $y, $col);
            }
        }
    }else if($direction == 1){
        addStringToFile(__DIR__ . "/direction.txt", "2");
        for($y = 0; $y < $height; $y++){
            for($x = 0; $x<$width; $x++){
                if($barW*0 <= $y && $y < $barW*1
                    || $barW*2 <= $y && $y < $barW*3
                    || $barW*4 <= $y && $y < $barW*5
                    || $barW*6 <= $y && $y < $barW*7
                ){
                    $col = imagecolorat($baseImg, $x, $y);
                }else{
                    $col =  imagecolorat($newImg, $x, $y);
                }
                imageSetPixel($outImg, $x, $y, $col);
            }
        }
    }else if($direction == 2){
        addStringToFile(__DIR__ . "/direction.txt", "3");
        for($y = 0; $y < $height; $y++){
            for($x = 0; $x<$width; $x++){
                if($barW*1 <= $x && $x < $barW*2
                    || $barW*3 <= $x && $x < $barW*4
                    || $barW*5 <= $x && $x < $barW*6
                    || $barW*7 <= $x && $x < $barW*8
                ){
                    $col = imagecolorat($baseImg, $x, $y);
                }else{
                    $col =  imagecolorat($newImg, $x, $y);
                }
                imageSetPixel($outImg, $x, $y, $col);
            }
        }
    }else if($direction == 3){
        addStringToFile(__DIR__ . "/direction.txt", "0");
        for($y = 0; $y < $height; $y++){
            for($x = 0; $x<$width; $x++){
                if($barW*1 <= $y && $y < $barW*2
                    || $barW*3 <= $y && $y < $barW*4
                    || $barW*5 <= $y && $y < $barW*6
                    || $barW*7 <= $y && $y < $barW*8
                ){
                    $col = imagecolorat($baseImg, $x, $y);
                }else{
                    $col =  imagecolorat($newImg, $x, $y);
                }
                imageSetPixel($outImg, $x, $y, $col);
            }
        }
    }
    return $outImg;
}


function parlinNoiseMix($baseImg, $newImg){
    $width = imageSx($baseImg);
    $height = imageSy($baseImg);
    $outImg = ImageCreateTrueColor($width, $height);

    $per = new Perlin;

    for($y = 0; $y < $height; $y++){
        for($x = 0; $x<$width; $x++){
    //        $num = $per->perlinNoise2d($x,$y) + 0.5; //parlin noise
            $num = $per->SmoothedNoise($x,$y) + 0.5; //smooth parlin noise
            if($num > 0.4){
                $col = imagecolorat($baseImg, $x, $y);
            }else{
                $col =  imagecolorat($newImg, $x, $y);
            }
            imageSetPixel($outImg, $x, $y, $col);
        }
    }
    return $outImg;
}

function randomMix($baseImg, $newImg){
    $width = imageSx($baseImg);
    $height = imageSy($baseImg);
    $outImg = ImageCreateTrueColor($width, $height);

    for($y = 0; $y < $height; $y++){
        for($x = 0; $x<$width; $x++){
            $num = mt_rand(0, 100); // total random
            if($num > 50){
                $col = imagecolorat($baseImg, $x, $y);
            }else{
                $col =  imagecolorat($newImg, $x, $y);
            }
            imageSetPixel($outImg, $x, $y, $col);
        }
    }
    return $outImg;
}
?>
