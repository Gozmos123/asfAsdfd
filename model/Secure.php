<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../');
    exit();
}

class Secure
{
    public static function encrypt($value)
    {
        // Store the cipher method
        $ciphering = "AES-128-CTR";
        // Use OpenSSl Encryption method
        $init_vector_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        // Non-NULL Initialization Vector for encryption
        $init_vector = 'T4YIPXRn31zEAhjr';
        // Store the encryption key
        $key = "BHIS_Secure_Value";
        // Use openssl_encrypt() function to encrypt the data
        $encrypted = openssl_encrypt(
            $value,
            $ciphering,
            $key,
            $options,
            $init_vector
        );

        return $encrypted;
    }

    public static function decrypt($value)
    {
        // Store the cipher method
        $ciphering = "AES-128-CTR";
        // Use OpenSSl Encryption method
        $init_vector_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        // Non-NULL Initialization Vector for encryption
        $init_vector = 'T4YIPXRn31zEAhjr';
        // Store the encryption key
        $key = "BHIS_Secure_Value";
        // Use openssl_encrypt() function to encrypt the data
        $decrypted = openssl_decrypt(
            $value,
            $ciphering,
            $key,
            $options,
            $init_vector
        );

        return $decrypted;
    }
}
