<?php 

namespace Core; 


class Crypto {

    //   protected $data;
    protected $key;
    protected $list_algo;
    protected $list_mode;
    protected $cipher = "blowfish";
    protected $mode =  "cfb";

    public function __construct()
    {  
        $this->key = md5('keayan'); 
        $this->list_algo = mcrypt_list_algorithms();
        $this->list_model = mcrypt_list_modes();
    }

    public function encrypt($data){
        if(is_array($data)) {
            $data = serialize($data) . 'array_type';
        }

        $key = substr(md5($this->key),0,mcrypt_get_key_size($this->cipher, $this->mode));
        $iv = substr(md5($this->key),0,mcrypt_get_block_size($this->cipher, $this->mode));

        $crypt = mcrypt_encrypt($this->cipher, $key, $data, $this->mode, $iv);

        return base64_encode($crypt);
    }

    public function decrypt($data) {

        $data  = base64_decode($data);
        $key = substr(md5($this->key),0,mcrypt_get_key_size($this->cipher, $this->mode));
        $iv = substr(md5($this->key),0,mcrypt_get_block_size($this->cipher, $this->mode));
        
        $decrypt = mcrypt_decrypt($this->cipher, $key, $data, $this->mode, $iv);

        $decrypt = explode('array_type', trim($decrypt));

        return $decrypt[0];
    }

}