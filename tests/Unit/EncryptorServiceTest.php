<?php

namespace Tests\Unit;

use App\Services\SaltEncryptorService;
use Tests\TestCase;

class EncryptorServiceTest extends TestCase
{
    /** @test */
    public function an_id_can_be_encrypted()
    {
        $id = 35;
        $encryptor = new SaltEncryptorService;

        $encryptedId = $encryptor->encrypt($id);

        $this->assertEquals(82, strlen($encryptedId));
    }

    /** @test */
    public function an_id_can_be_decrypted()
    {
        $id = 35;
        $encryptor = new SaltEncryptorService;
        $encryptedId = $encryptor->encrypt($id);

        $decryptedId = $encryptor->decrypt($encryptedId);

        $this->assertEquals(35, $decryptedId);
    }

    /** @test */
    public function a_string_can_be_encrypted()
    {
        $string = "Jacques";
        $encryptor = new SaltEncryptorService;

        $encryptedString = $encryptor->encrypt($string);

        $this->assertEquals(82, strlen($encryptedString));
    }

    /** @test */
    public function a_string_can_be_decrypted()
    {
        $string = "Jacques";
        $encryptor = new SaltEncryptorService;
        $encryptedString = $encryptor->encrypt($string);

        $decryptedString = $encryptor->decrypt($encryptedString);

        $this->assertEquals('Jacques', $decryptedString);
    }
}
