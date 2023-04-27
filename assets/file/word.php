<?php
include "vendor/autoload.php";
$zip = new ZipArchive();
 
$Title = 'TẠO REPORT MS WORD THEO MẪU CỐ ĐỊNH THẬT ĐƠN GIẢN VỚI PHP';
$Content1 = 'Tôi đã tạo được report word!';
$Content2 = 'Report tôi tạo rất đẹp!';
 
$filename_goc = 'bill.docx';
$filename = 'cbill'.time().'.docx';
// Copy một bản sao từ file gốc
copy($filename_goc, $filename);
 
// Mở file đã copy
if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
    echo "Cannot open $filename :( "; die;
}
// Lấy nội dung text trong file
$xml = $zip->getFromName('word/document.xml');
 
// Dùng hàm str_replace để thay đổi text trong file
$xml = str_replace('{Title}', $Title, $xml);
$xml = str_replace('{Content1}', $Content1, $xml);
$xml = str_replace('{Content2}', $Content2, $xml);
 
// Ghi lại nội dung đã được đổi vào file
if ($zip->addFromString('word/document.xml', $xml)) { echo 'File written!'; }
else { echo 'File not written.  Go back and add write permissions to this folder!'; }
 
//Đóng file
$zip->close();
 
header('Location: '.$filename);