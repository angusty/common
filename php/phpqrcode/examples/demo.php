<?php
include_once __DIR__ . '/../phpqrcode.php';
//二维码数据
$data = 'http://angusty.com';
//生成文件名
$filename = __DIR__ . '/images/angusty.png';
//纠错级别 取值： 纠错级别：L、M、Q、H
$error_correction_level = 'M';
//点的大小 取值范围：1到10  点越大相应的图片就越大
$matrix_point_size = 5;
//边距
$margin = 2;
QRcode::png($data, $filename, $error_correction_level, $matrix_point_size, $margin);

//在二维码中插入logo
$qr = $filename;
$logo = __DIR__ . '/images/logo.jpg';
$qr = imagecreatefromstring(file_get_contents($qr));
$logo = imagecreatefromstring(file_get_contents($logo));
$qr_width = imagesx($qr);
$qr_height = imagesy($qr);
$logo_width = imagesx($logo);
$logo_height = imagesy($logo);
$logo_qr_width = $qr_width/5;
$scale = $logo_width/$logo_qr_width;
$logo_qr_height = $logo_height/$scale;
$from_width = ($qr_width-$logo_qr_width)/2;
imagecopyresampled($qr, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
$to_filename = __DIR__ . '/images/new_code.png';
imagepng($qr, $to_filename);

