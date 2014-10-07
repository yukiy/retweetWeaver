<?php
    /*
    * (stirng $filename, int $targetW, int $targetW, bool $keepRatio)
    */
    function resizeImage($filename, $targetW, $targetH, $keepRatio){

        header('Content-Type: image/jpeg');

        //---get original image size and ratio
        list($originalW, $originalH) = getimagesize($filename);

        if($keepRatio){
            $originalRatio = $originalW / $originalH;
            $targetRatio = $targetW/$targetH;

            if ($targetRatio > $originalRatio) {
               $targetW = $targetH*$originalRatio;
            } else {
               $targetH = $targetW/$originalRatio;
            }
        }

        $targetImg = imagecreatetruecolor($targetW, $targetH);

        //---check image file format JPG or PNG
        if(stristr($filename, "jpg") || stristr($filename, "jpeg")){
            $originalImg = ImageCreateFromJPEG($filename);
        }else if(stristr($filename, "png")){
            $originalImg = ImageCreateFromPNG($filename);
        }

        imagecopyresampled($targetImg, $originalImg, 0, 0, 0, 0, $targetW, $targetH, $originalW, $originalH);

        /*bool imagejpeg(resource $image [, string $filename [, int $quality ]] )*/
        //imagejpeg($targetImg, null, 100);

        return $targetImg;
    }

?>
