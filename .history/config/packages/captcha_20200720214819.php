<?php 
// app/config/packages/captcha.php
if (!class_exists('CaptchaConfiguration')) { return; }

// BotDetect PHP Captcha configuration options
return [
    // Captcha configuration for example form
    'ExampleCaptchaContact' => [
        'ContactInput' => 'captchaCode',
        'ImageWidth' => 250,
        'ImageHeight' => 50,
    ],
];