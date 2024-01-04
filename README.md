# Buto-Plugin-CryptOpenssl



<a name="key_0"></a>

## Methods



<a name="key_0_0"></a>

### encrypt

<p>Encrypt _my_secret<em>text</em> with password 123456.</p>
<pre><code>wfPlugin::includeonce('crypt/openssl');
$crypt = new PluginCryptOpenssl();
$crypt-&gt;data-&gt;set('passphrase', '123456');
$crypt-&gt;data-&gt;set('data', '_my_secret_text_');
wfHelp::print($crypt-&gt;encrypt());
wfHelp::print($crypt-&gt;data-&gt;get());</code></pre>
<p>Result is in variable encryption.</p>
<pre><code>data: _my_secret_text_
cipher_algo: AES-128-CTR
options: 0
iv: abcdefghijklmnop
passphrase: '123456'
encryption: lAsK4iEwNB8JF3EcaFEKpw==
decryption: null</code></pre>
<p>One could also pass parameters direct in method.</p>
<pre><code>$temp = $crypt-&gt;encrypt('_my_secret_text_', '123456');</code></pre>

<a name="key_0_1"></a>

### decrypt

<p>Decrypt with password 123456.</p>
<pre><code>wfPlugin::includeonce('crypt/openssl');
$crypt = new PluginCryptOpenssl();
$crypt-&gt;data-&gt;set('passphrase', '123456');
$crypt-&gt;data-&gt;set('encryption', 'lAsK4iEwNB8JF3EcaFEKpw==');
wfHelp::print($crypt-&gt;decrypt());
wfHelp::print($crypt-&gt;data-&gt;get());</code></pre>
<p>Result is in variable decryption.</p>
<pre><code>data: _change_this_data_
cipher_algo: AES-128-CTR
options: 0
iv: abcdefghijklmnop
passphrase: '123456'
encryption: lAsK4iEwNB8JF3EcaFEKpw==
decryption: _my_secret_text_</code></pre>
<p>One could also pass parameters direct in method.</p>
<pre><code>$temp = $crypt-&gt;decrypt('lAsK4iEwNB8JF3EcaFEKpw==', '123456');</code></pre>

<a name="key_0_2"></a>

### decrypt_from_key

<p>Params.</p>
<ul>
<li>value</li>
</ul>
<p>Usage.</p>
<ul>
<li>If value starts with 'crypt:'.</li>
<li>If file /config/crypt.yml exist with param key.</li>
</ul>
<pre><code>wfPlugin::includeonce('crypt/openssl');
$crypt = new PluginCryptOpenssl();
$crypt-&gt;decrypt_from_key('crypt:abcdefgh'), </code></pre>

<a name="key_1"></a>

## Pages

<ul>
<li>Use this pages to encrypt or decrypt values. </li>
<li>Using key in file /config/crypt.yml.</li>
</ul>

<a name="key_1_0"></a>

### encrypt

<pre><code>http://localhost/?webmaster_plugin=crypt/openssl&amp;page=encrypt&amp;value=test</code></pre>
<p>Output.</p>
<pre><code>key: (Param key in /config/crypt.yml)
value: test
result: rmqWKQ==</code></pre>

<a name="key_1_1"></a>

### decrypt

<pre><code>http://localhost/?webmaster_plugin=crypt/openssl&amp;page=decrypt&amp;value=rmqWKQ==</code></pre>
<p>Output.</p>
<pre><code>key: (Param key in /config/crypt.yml)
value: rmqWKQ
result: test            </code></pre>

