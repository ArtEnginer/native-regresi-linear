<?php
include_once 'Config/koneksi.php'; // Sertakan file koneksi

class TransaksiModel
{

    public function __construct($koneksi)
    {
        $koneksi = new Koneksi();
        $this->koneksi = $koneksi->getKoneksi();
    }
    public function index()
    {
        $query = "SELECT * FROM transaksi";
        $result = $this->koneksi->query($query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $result->free();
        return $data;
    }

    public function add($data)
    {
        $nama = $data['nama'];
        $jumlah = $data['jumlah'];

        $query = "INSERT INTO transaksi (nama, jumlah) VALUES ('$nama', '$jumlah')";
        $this->koneksi->query($query);
    }

    public function delete($id)
    {
        $query = "DELETE FROM transaksi WHERE id = $id";
        $this->koneksi->query($query);
    }

    public function show($id)
    {
        $query = "SELECT * FROM transaksi WHERE id = $id";
        $result = $this->koneksi->query($query);
        return $result->fetch_assoc();
    }

    public function update($data)
    {
        $id = $data['id'];
        $nama = $data['nama'];
        $jumlah = $data['jumlah'];

        $query = "UPDATE transaksi SET nama = '$nama', jumlah = '$jumlah' WHERE id = $id";
        $this->koneksi->query($query);
    }

    public function import($data)
    {
        $query = "INSERT INTO transaksi (nama, jumlah) VALUES ";
        $queryValue = "";
        for ($i = 0; $i < count($data); $i++) {
            $nama = $data[$i]['nama'];
            $jumlah = $data[$i]['jumlah'];
            $queryValue .= "('$nama', '$jumlah'),";
        }
        $queryValue = rtrim($queryValue, ',');
        $query .= $queryValue;
        $this->koneksi->query($query);
    }
}
