<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once CIPLUS_PATH . 'CIClass.php';

/**
 * 全局参数获取
 * Class GlobalParams
 * @method Load($key)           => LoadFrom.$this->driver
 * @method Set($key, $value)    => SetIn.$this->driver
 */
class GlobalParams extends \CIPlus\CIClass {
    protected $driver;
    protected $prefix;
    protected $global_params_list;

    private $params = array();

    public function __construct() {
        parent::__construct();
        $this->LoadConf('global_params');
        $this->LoadDriver();
        $this->AnalyseParams();
    }

    /**
     * 访问路由
     * @param $method
     * @param $params
     * @return mixed
     */
    public function __call($method, $params) {
        if ($method === "Load") {
            $method = $method . 'From' . ucfirst($this->driver);
            if (method_exists($this, $method)) {
                return $this->$method($params[0]);
            }
        } elseif ($method === "Set") {
            $method = $method . 'In' . ucfirst($this->driver);
            if (method_exists($this, $method)) {
                return $this->$method($params[0], $params[1]);
            }
        }
        return null;
    }

    /**
     * 直接从当前获取全局参数
     * @param $key
     * @return string
     */
    public function Get($key) {
        $key = $key = $this->ParamsKey($key);
        if (key_exists($key, $this->params)) {
            return $this->params[$key];
        }
        return '';
    }

    /**
     * 从session中读取
     * @param $key
     * @return mixed
     */
    public function LoadFromSession($key) {
        $key = $this->ParamsKey($key);
        return $this->CI->session->$key;
    }

    /**
     * 从cookie中读取
     * @param $key
     * @return mixed
     */
    public function LoadFromCookie($key) {
        $key = $this->ParamsKey($key);
        return $this->CI->input->cookie($key);
    }

    /**
     * 将参数写入session
     */
    public function SaveInSession() {
        $this->CI->session->set_userdata($this->params);
    }

    /**
     * 将参数写入cookie
     */
    public function SaveInCookie() {
        foreach ($this->params as $key => $value) {
            $this->CI->input->set_cookie($key, $value, 7200);
        }
    }

    /**
     * 设置Session中的参数
     * @param $key
     * @param $value
     */
    public function SetInSession($key, $value) {
        $key = $this->ParamsKey($key);
        $this->CI->session->set_userdata($key, $value);
    }

    /**
     * 设置cookie中的参数
     * @param $key
     * @param $value
     */
    public function SetInCookie($key, $value) {
        $key = $this->ParamsKey($key);
        $this->CI->input->set_cookie($key, $value, 7200);
    }

    /**
     * 构造全局参数key
     * @param $key
     * @return string
     */
    private function ParamsKey($key) {
        return $this->prefix . $key;
    }

    /**
     * 加载全局参数会话引擎
     */
    private function LoadDriver() {
        if ($this->driver === 'session') {
            $this->CI->load->library('session');
        } elseif ($this->driver === 'cookie') {
//            $this->CI->load->helper('cookie');
        } else {
            show_error('Class GlobalParams Driver config error');
        }
    }

    /**
     * 解析全局参数
     */
    private function AnalyseParams() {
        $params = $this->CI->input->get();
        foreach ($this->global_params_list as $key) {
            $key = $this->ParamsKey($key);
            if (key_exists($key, $params)) {
                $this->params = array_merge($this->params, array($key => $params[$key]));
            }
        }
        $this->SaveInDriver();
    }

    /**
     * 保存至会话引擎
     */
    private function SaveInDriver() {
        $method = 'SaveIn' . ucfirst($this->driver);
        $this->$method();
    }

}