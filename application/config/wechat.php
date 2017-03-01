<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['appid'] = ''; // 公众号APP ID
$config['secret'] = ''; // 公众号APP SECRET
$config['token'] = ''; // 服务器通信认证 TOKEN
$config['aeskey'] = ''; // 服务器通信认证 TOKEN
$config['mchid'] = ''; // 商户号
$config['mchkey'] = ''; // 商户支付密钥
$config['notify_url'] = base_url('wxpay/jsapi'); // 支付通知回调地址
//=======【证书路径设置】=====================================
/**
 * TODO：设置商户证书路径
 * 证书路径,注意应该填写绝对路径（仅退款、撤销订单时需要，可登录商户平台下载，
 * API证书下载地址：https://pay.weixin.qq.com/index.php/account/api_cert，下载之前需要安装商户操作证书）
 */
$config['sslcert_path'] = '';
$config['sslkey_path'] = '';

//=======【curl代理设置】===================================
/**
 * TODO：这里设置代理机器，只有需要代理的时候才设置，不需要代理，请设置为0.0.0.0和0
 * 本例程通过curl使用HTTP POST方法，此处可修改代理服务器，
 * 默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
 */
$config['curl_proxy_host'] = '0.0.0.0';
$config['curl_proxy_port'] = 0;
//=======【上报信息配置】===================================
/**
 * TODO：接口调用上报等级，默认紧错误上报（注意：上报超时间为【1s】，上报无论成败【永不抛出异常】，
 * 不会影响接口调用流程），开启上报之后，方便微信监控请求调用的质量，建议至少
 * 开启错误上报。
 * 上报等级，0.关闭上报; 1.仅错误出错上报; 2.全量上报
 * @var int
 */
$config['report_level'] = 1; // SDK 单词 LEVENL