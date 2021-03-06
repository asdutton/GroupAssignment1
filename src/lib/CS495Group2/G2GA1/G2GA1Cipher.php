<?php
namespace  CS495Group2\G2GA1;

class G2GA1Cipher
{
    // Monocase English alpahbet lenght
    const MODULUS = 26;
    // Holds matrix generated by KDF
    private $matrix;


/* G2GA1 Cryptographic Primitives
============================================================================= */

    // G2GA1 encryption
    public function encrypt($plainText, $k1, $k2, $k3)
    {
        // Run KDF function using k1 and k2
        $this->kdf($k1, $k2);

        // Generate ordered pairs string
        $orderedPairs = $this->encRound1($plainText);

        // Encode ordered pairs string
        $orderedPairsEncoded = $this->encRound2($orderedPairs);

        // Encrypt the encoded ordered pairs string with Vigenere Cipher
        $cipherText = $this->encRound3($orderedPairsEncoded, $k3);

        return $cipherText;
    }

    // G2GA1 decryption
    public function decrypt($cipherText, $k1, $k2, $k3)
    {
        // Run KDF function using k1 and k2
        $this->kdf($k1, $k2);

        // Decrypt the encoded ordered pairs string with Vigenere Cipher
        $orderedPairsEncoded = $this->decRound1($cipherText, $k3);

        // Decode the ordered pairs string
        $orderedPairs = $this->decRound2($orderedPairsEncoded);

        // Lookup the origional plaintext from the ordered pairs string
        $plainText = $this->decRound3($orderedPairs);

        return $plainText;
    }

    // G2GA1 key derivation function
    private function kdf($k1, $k2)
    {
        // TODO: Code me!
        // Store modified k1 key in $this->matrix
    }


/* Encryption Rounds
============================================================================= */

    // Encryption Round 1 - Stochastic plaintext mapping
    private function encRound1($plainText)
    {
        $orderedPairs = '';

        // TODO: Code me!

        return $orderedPairs;
    }

    // Encryption Round 2 - Coordinate encoding
    private function encRound2($orderedPairs)
    {
        $orderedPairsEncoded = '';

        // TODO: Code me!

        return $orderedPairsEncoded;
    }

    // Encryption Round 3 - Vigenère Cipher encryption
    private function encRound3($orderedPairsEncoded, $k3)
    {
        // Process key
        for ($i = 0; $i < strlen($k3); $i++) {
            $key[$i] = ord(strtoupper(substr($k3, $i, 1))) - 65;
        }

        // Process encoded ordered pairs string
        $row = 0;
        for ($i = 0; $i < strlen($orderedPairsEncoded); $i++) {
            // Move to the next row when index is a multiple of the key
            if ($i > 0 && $i % count($key) == 0) {
                ++$row;
            }
            // Store each plaintext character in matrix entry in decimal format
            $plainTextMatrix[$row][] = ord(
                strtoupper(substr($orderedPairsEncoded, $i, 1))
            )-65;
        }

        // Encrypt plaintext
        foreach ($plainTextMatrix as $column) {
            for ($i = 0; $i < count($column); $i++) {
                $cipherCharDec = ($column[$i] + $key[$i]) % self::MODULUS;
                // No negative cipher characters in decimal format
                while ($cipherCharDec < 0) {
                    $cipherCharDec += self::MODULUS;
                }
                $cipherText .= chr($cipherCharDec + 65);
            }
        }

        return $cipherText;
    }


/* Decryption Rounds
============================================================================= */

    // Decryption Round 1 - Vigenère Cipher decryption
    private function decRound1($cipherText, $k3)
    {
        // Process key
        for ($i = 0; $i < strlen($k3); $i++) {
            $key[$i] = ord(strtoupper(substr($k3, $i, 1))) - 65;
        }

        // Process ciphertext
        $row = 0;
        for ($i = 0; $i < strlen($cipherText); $i++)
        {
            if ($i > 0 && $i % count($key) == 0)
            {
                ++$row;
            }
            $cipherTextMatrix[$row][] = ord(
                strtoupper(substr($cipherText, $i, 1))
            )-65;
        }

        // Decrypt ciphertext
        foreach ($cipherTextMatrix as $column) {
            for ($i = 0; $i < count($column); $i++) {
                $plainCharDec = ($column[$i] - $key[$i]) % self::MODULUS;
                while ($plainCharDec < 0) {
                    $plainCharDec += self::MODULUS;
                }
                $orderedPairsEncoded .= chr($plainCharDec + 65);
            }
        }

        return $orderedPairsEncoded;
    }

    // Decryption Round 2 - Coordinate decoding
    private function decRound2($orderedPairsEncoded)
    {
        $orderedPairs = '';

        // TODO: Code me!

        return $orderedPairs;
    }

    // Decryption Round 3 - Plaintext lookup
    private function decRound3($orderedPairs)
    {
        $plainText = '';

        // TODO: Code me!

        return $plainText;
    }
}