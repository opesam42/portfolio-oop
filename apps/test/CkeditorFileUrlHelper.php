<?php
require_once __DIR__ . '../../misc/CkeditorFileUrlHelper.php';

$str = 'JavaScript</li></ul><h3><strong>Design Process</strong></h3><figure class="image"><img src="https://f003.backblazeb2.com/file/eaglespoint-website/gbenga_portfolio/project/pain formular for email marketing 2.jpg"></figure><p>There was already a design file meant for the landing page, but it had a lot of design problems. The page was cluttered with excessive brand colors and lacked a compelling flow to explain how Zepama addresses the real-world problems of underprivileged communities. Furthermore, the app demo and partner opportun';

$ckeditor_file_helper = new CkeditorFileUrlHelper();

$cleaned_str = $ckeditor_file_helper->stripBaseUrl($str); 

$append_str = $ckeditor_file_helper->appendBaseUrl($cleaned_str);

echo "<h1>STRING WITHOUT B2 URL</h1>";
echo "<pre>" . htmlspecialchars($cleaned_str) . "</pre>";

echo "<h1>STRING WITH B2 URL</h1>";
echo "<pre>" . htmlspecialchars($append_str) . "</pre>";

$password = "C# Language1";  // your real password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

echo $hashedPassword;
