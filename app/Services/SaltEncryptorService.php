<?php

namespace App\Services;

class SaltEncryptorService
{
    private string $salt;

    public function __construct()
    {
        $this->salt = config('services.salt-encryptor.key');
    }

    public function encrypt(int|string $toEncrypt): string
    {
        $iv = substr(sha1(strval(mt_rand())), 0, 16);
        $password = sha1($this->salt);

        $salt = sha1(strval(mt_rand()));
        $saltWithPassword = hash('sha256', $password . $salt);

        $encrypted = openssl_encrypt(
            "$toEncrypt",
            'aes-256-cbc',
            "$saltWithPassword",
            0,
            $iv
        );

        $msg_encrypted_bundle = "$iv:$salt:$encrypted";

        return $msg_encrypted_bundle;
    }

    public function decrypt(string $toDecrypt): bool|string
    {
        $password = sha1($this->salt);

        $components = explode(':', $toDecrypt);
        $iv = $components[0];
        $salt = hash('sha256', $password . $components[1]);
        $encrypted_msg = $components[2];

        $decrypted_msg = openssl_decrypt(
            $encrypted_msg,
            'aes-256-cbc',
            $salt,
            0,
            $iv
        );

        if ($decrypted_msg === false) {
            return false;
        }

        return $decrypted_msg;
    }
}
