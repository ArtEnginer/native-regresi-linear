<?php
include_once 'Config/koneksi.php'; // Sertakan file koneksi

class UserModel
{
    public function __construct($koneksi)
    {
        $koneksi = new Koneksi();
        $this->koneksi = $koneksi->getKoneksi();
        $this->table = 'users';
    }

    public function getByUsername($username)
    {
        // Example query to get user by username
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->koneksi->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
}
