<?php defined('BASEPATH') OR exit('No direct script access allowed');
$config['expire_time'] = 3600; // Token有效周期 单位：秒（second）

$config['encryption'] = [ // 加密方法，可配置多种方案
    'simple' => [
        'cipher' => 'aes-128',
        'mode' => 'cbc',
        'key' => '4355efff001b9a11b1bd0598313c5ff1',
        'hmac' => false
    ],
    'r1' => [
        'cipher' => 'aes-256',
        'mode' => 'cbc',
        'key' => '4355efff001b9a11b1bd0598313c5ff1',
        'hmac' => false
    ]
];

$config['header_required'] = ['typ', 'rap'];
$config['payload_required'] = ['id', 'iat', 'exp'];