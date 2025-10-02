<?php

namespace Wordpress\Services;

/**
 * Class PasswordService
 *
 * @author Mickael Burguet <www.rundef.com>
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class PasswordService
{
    public function __construct()
    {
        $this->hasher = new PasswordHash(8, true);
    }

    /**
     * Create a hash (encrypt) of a plain text password.
     *
     * @param  string  $password  Plain text user password to hash
     * @return string The hash string of the password
     */
    public function makeHash($password)
    {
        $dbVersion = Option::where('option_name', 'db_version')->first()->option_value;
        $isAtLeast68 = $dbVersion >= 58975;

        if ($isAtLeast68) {
            $password_to_hash = base64_encode(hash_hmac('sha384', trim($password), 'wp-sha384', true));

            // Default $options: WordPress 6.8 uses ['cost' => 10] for bcrypt
            // This can be overwritten by $options = apply_filters( 'wp_hash_password_options', array(), $algorithm ); though!
            $options = ['cost' => 10];

            // Add a prefix to facilitate distinguishing vanilla bcrypt hashes.
            return '$wp'.password_hash($password_to_hash, PASSWORD_BCRYPT, $options);
        } else {
            return $this->hasher->HashPassword(trim($password));
        }
    }

    /**
     * Checks the plaintext password against the encrypted Password.
     *
     * @param  string  $password  Plaintext password
     * @param  string  $hash  Hashed password
     * @return bool
     */
    public function check($password, $hash)
    {
        if (strlen($hash) <= 32) { // if the hash is still md5
            return $hash === md5($password);
        }
        if (str_starts_with($hash, '$wp')) { // fix for 6.8 wordpress
            $password_to_verify = base64_encode(hash_hmac('sha384', $password, 'wp-sha384', true));

            return password_verify($password_to_verify, substr($hash, 3));
        }

        return $this->hasher->CheckPassword($password, $hash);
    }
}
