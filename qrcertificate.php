<?php
require 'vendor/autoload.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $download = $_GET['download'];
    $userkey = $_GET['key'];

    // QR code validating link
    $link = "www.gdgjammu.com/B2BCertificate.php?key=" . $userkey;

    //Invoking barcode function
    $barcode = new \Com\Tecnick\Barcode\Barcode();
    $targetPath = "qr-code/";

    if (!is_dir($targetPath)) {
        mkdir($targetPath, 0777, true);
    }
    $bobj = $barcode->getBarcodeObj('QRCODE,H', $link, -16, -16, 'black', array(
        -2,
        -2,
        -2,
        -2,
    ))->setBackgroundColor('#f0f0f0');

    //Generating image data
    $imageData = $bobj->getPngData();
    $timestamp = time();

    //Saving qr code
    file_put_contents($targetPath . $timestamp . '.jpg', $imageData);

    // QR code image
    $filename = $targetPath . $timestamp . ".jpg";
    // Get the name from the URL or GET Parameters.
    $name = isset($_GET["name"]) ? $_GET["name"] : $id;
    // Create an image from the PNG that I have got.
    $image = imagecreatefrompng("assets/template.png");
    // Create a text colour.
    $textColour = imagecolorallocate($image, 0, 0, 0);
    // Get the font path.
    $fontPath = __DIR__ . "/font.otf";
    // Get the bounding box of the text.
    $coords = imagettfbbox(60, 0, $fontPath, $name);
    // Import the custom font from path.
    // Write text inside image.
    // Left margin should be negated with half width of the text.
    // Current text width is given by the above $coords, so divide it by 2.
    imagettftext($image, 64, 0, 1000 - ($coords[2] / 2), 644, $textColour, $fontPath, $name);

    //Qrcode
    $src = imagecreatefrompng($filename);
    $imgresize = imagescale($src, 160, 160);

    imagealphablending($image, false);
    imagesavealpha($image, true);
    // Copy and merge
    imagecopymerge($image, $imgresize, 1785, 50, 0, 0, 160, 160, 90);

    // Instruct the browser to read this page as image.
    header("Content-type: image/png");

    // Savng certificate with download parameter as y.
    if ($download == 'y') {
        header('Content-Disposition: attachment; filename="B2B_GDGJammu_Certificate.jpg"');
        imagepng($image);
        imagedestroy($image);
        if (file_exists($filename)) {
            unlink($filename);
        }
    } else // Show the image to the browser or output.
    {
        imagepng($image);
    }

    // Destroy the image in the memory.
    //imagedestroy($image);

}
