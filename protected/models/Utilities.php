<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Utilities {

    public static function getYear($length = 50) {
        $listYear = array();
        $currentYear = date('Y');
        for ($i = $currentYear; $i > ($currentYear - $length); $i--) {
            $listYear[] = $i;
        }
        return $listYear;
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function resizeImage($pathFolder, $image,$width, $height) {
        // parameter => $image
        /* Get original image x y */
        //var_dump($image);
        //exit();
        $newName = '';
        $imageType = '';
        try {
            $imageType = $image['type'];

            list($w, $h) = getimagesize($image['tmp_name']);
            /* calculate new image size with ratio */
            $ratio = max($width / $w, $height / $h);
            $h = ceil($height / $ratio);
            $x = ($w - $width / $ratio) / 2;
            $w = ceil($width / $ratio);

            /* new file name */
            $imageExtension = explode("/", $imageType);
           
            $newName = $width . 'x' . $height . '_' . Utilities::generateRandomString(10) . '.' . $imageExtension[1];
            $path = $pathFolder . $newName;

            /* read binary data from image file */
            $imgString = file_get_contents($image['tmp_name']);
            /* create image from string */
            $image = imagecreatefromstring($imgString);
            $tmp = imagecreatetruecolor($width, $height);
            imagecopyresampled($tmp, $image, 0, 0, $x, 0, $width, $height, $w, $h);


            /* Save image */
            if ($imageType === 'image/jpeg' || $imageType == 'image/JPEG' || $imageType == 'image/jpg' || $imageType == 'image/JPG') {
                imagejpeg($tmp, $path, 100);
            } else if ($imageType == 'image/png' || $imageType == 'image/PNG') {
                imagepng($tmp, $path, 0);
            } else if ($imageType == 'image/GIF' || $imageType == 'image/gif') {
                imagegif($tmp, $path);
            } else {
                echo 'image_type ::==' . $imageType;
                exit();
            }

            /* cleanup memory */
            imagedestroy($image);
            imagedestroy($tmp);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            exit();
        }
        return $newName;
    }

}
