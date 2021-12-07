# Buto-Plugin-CryptOpenssl
Encryption and decryption.

## Encrypt
Encrypt _my_secret_text_ with password 123456.
```
wfPlugin::includeonce('crypt/openssl');
$crypt = new PluginCryptOpenssl();
$crypt->data->set('passphrase', '123456');
$crypt->data->set('data', '_my_secret_text_');
wfHelp::print($crypt->encrypt());
wfHelp::print($crypt->data->get());
```
Result is in variable encryption.
```
data: _my_secret_text_
cipher_algo: AES-128-CTR
options: 0
iv: abcdefghijklmnop
passphrase: '123456'
encryption: lAsK4iEwNB8JF3EcaFEKpw==
decryption: null
```
One could also pass parameters direct in method.
```
$temp = $crypt->encrypt('_my_secret_text_', '123456');
```

## Decrypt
Decrypt with password 123456.
```
wfPlugin::includeonce('crypt/openssl');
$crypt = new PluginCryptOpenssl();
$crypt->data->set('passphrase', '123456');
$crypt->data->set('encryption', 'lAsK4iEwNB8JF3EcaFEKpw==');
wfHelp::print($crypt->decrypt());
wfHelp::print($crypt->data->get());
```
Result is in variable decryption.
```
data: _change_this_data_
cipher_algo: AES-128-CTR
options: 0
iv: abcdefghijklmnop
passphrase: '123456'
encryption: lAsK4iEwNB8JF3EcaFEKpw==
decryption: _my_secret_text_
```
One could also pass parameters direct in method.
```
$temp = $crypt->decrypt('lAsK4iEwNB8JF3EcaFEKpw==', '123456');
```








