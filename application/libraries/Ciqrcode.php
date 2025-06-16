<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ciqrcode {
    
    public $cacheable = true;
    public $cachedir = 'application/cache/';
    public $errorlog = 'application/logs/';
    public $quality = true;
    public $size = 1024;
    
    public function __construct($config = array()) {
        $this->initialize($config);
        require_once APPPATH.'libraries/phpqrcode/qrlib.php';
    }
    
    public function initialize($config = array()) {
        $this->cacheable = (isset($config['cacheable'])) ? $config['cacheable'] : $this->cacheable;
        $this->cachedir = (isset($config['cachedir'])) ? $config['cachedir'] : APPPATH.$this->cachedir;
        $this->errorlog = (isset($config['errorlog'])) ? $config['errorlog'] : APPPATH.$this->errorlog;
        $this->quality = (isset($config['quality'])) ? $config['quality'] : $this->quality;
        $this->size = (isset($config['size'])) ? $config['size'] : $this->size;
        
        // Pastikan folder cache ada
        if ($this->cacheable && !is_dir($this->cachedir)) {
            mkdir($this->cachedir, 0755, true);
        }
    }
    
    public function generate($params = array()) {
        if (!isset($params['data']) || empty($params['data'])) {
            log_message('error', 'QRCode: Data tidak boleh kosong');
            return false;
        }
        
        // Default parameter
        $defaults = array(
            'data' => '',
            'level' => 'L',
            'size' => 4,
            'savename' => false,
            'quality' => $this->quality,
            'cachedir' => $this->cachedir,
            'errorlog' => $this->errorlog,
            'cacheable' => $this->cacheable
        );
        
        $params = array_merge($defaults, $params);
        
        // Generate QR Code
        QRcode::png(
            $params['data'],
            $params['savename'],
            $params['level'],
            $params['size'],
            $params['quality'],
            $params['cacheable']
        );
        
        return $params['savename'];
    }
}