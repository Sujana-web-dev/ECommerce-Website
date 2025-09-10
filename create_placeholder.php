<?php
// Create a simple placeholder image for missing product images
$width = 200;
$height = 200;

// Create image
$image = imagecreate($width, $height);

// Colors
$bg_color = imagecolorallocate($image, 243, 244, 246); // Light gray
$text_color = imagecolorallocate($image, 156, 163, 175); // Gray

// Fill background
imagefill($image, 0, 0, $bg_color);

// Add text
$text = "No Image";
$font_size = 5;
$text_width = imagefontwidth($font_size) * strlen($text);
$text_height = imagefontheight($font_size);
$x = ($width - $text_width) / 2;
$y = ($height - $text_height) / 2;

imagestring($image, $font_size, $x, $y, $text, $text_color);

// Output image
header('Content-Type: image/png');
imagepng($image, 'c:\Users\SUJANA\OneDrive\Desktop\Ecommerce_Website\public\images\no-image.png');
imagedestroy($image);

echo "Placeholder image created successfully!";
?>
