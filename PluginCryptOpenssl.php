<?php
class PluginCryptOpenssl{
  public $data = null;
  function __construct() {
    wfPlugin::includeonce('wf/array');
    $data = new PluginWfArray();
    $data->set('data', '_change_this_data_');
    $data->set('cipher_algo', 'AES-128-CTR');
    $data->set('options', 0);
    $data->set('iv', 'abcdefghijklmnop'); // Must be 16 characters.
    $data->set('passphrase', '123456');
    $data->set('encryption', null);
    $data->set('decryption', null);
    $this->data = $data;
  }
  public function encrypt($data = null, $passphrase = null){
    if($data){
      $this->data->set('data', $data);
    }
    if($passphrase){
      $this->data->set('passphrase', $passphrase);
    }
    $encryption = openssl_encrypt($this->data->get('data'), $this->data->get('cipher_algo'), $this->data->get('passphrase'), $this->data->get('options'), $this->data->get('iv'));
    $this->data->set('encryption', $encryption);
    return $encryption;
  }
  public function decrypt($encryption = null, $passphrase = null){
    if($encryption){
      $this->data->set('encryption', $encryption);
    }
    if($passphrase){
      $this->data->set('passphrase', $passphrase);
    }
    $decryption = openssl_decrypt($this->data->get('encryption'), $this->data->get('cipher_algo'), $this->data->get('passphrase'), $this->data->get('options'), $this->data->get('iv'));
    $this->data->set('decryption', $decryption);
    return $decryption;
  }
  public function decrypt_from_key($value){
    if(substr((string) $value, 0, 6)=='crypt:'){
      $key = wfCrypt::getKey();
      if($key){
        return $this->decrypt(substr((string) $value, 6), $key);
      }else{
        throw new Exception(__CLASS__." says: No crypt key exist!");
      }
    }else{
      return $value;
    }
  }
  public function page_encrypt(){
    $data = new PluginWfArray();
    $data->set('key', wfCrypt::getKey());
    $data->set('value', wfRequest::get('value'));
    $data->set('result', $this->encrypt($data->get('value'), $data->get('key')));
    wfHelp::print($data);
  }
  public function page_decrypt(){
    $data = new PluginWfArray();
    $data->set('key', wfCrypt::getKey());
    $data->set('value', wfRequest::get('value'));
    $data->set('result', $this->decrypt($data->get('value'), $data->get('key')));
    wfHelp::print($data);
  }
}