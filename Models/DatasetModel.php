<?php
include_once 'Config/koneksi.php'; // Sertakan file koneksi

class DatasetModel
{
    public function __construct($koneksi)
    {
        $koneksi = new Koneksi();
        $this->koneksi = $koneksi->getKoneksi();
        $this->table = 'dataset';
    }
    public function all()
    {
        $query = "SELECT * FROM $this->table";
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
        $x = $data['x'];
        $y = $data['y'];
        $query = "INSERT INTO $this->table (x, y) VALUES ('$x', '$y')";
        $this->koneksi->query($query);
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id = $id";
        $this->koneksi->query($query);
    }

    public function show($id)
    {
        $query = "SELECT * FROM $this->table WHERE id = $id";
        $result = $this->koneksi->query($query);
        return $result->fetch_assoc();
    }

    public function update($data)
    {
        $id = $data['id'];
        $x = $data['x'];
        $y = $data['y'];

        $query = "UPDATE $this->table SET x = '$x', y = '$y' WHERE id = $id";
        $this->koneksi->query($query);
    }

    public function import($data)
    {
        $query = "INSERT INTO $this->table (x, y) VALUES ";
        $queryValue = "";
        for ($i = 0; $i < count($data); $i++) {
            $x = $data[$i]['x'];
            $y = $data[$i]['y'];
            $queryValue .= "('$x', '$y'),";
        }
        $queryValue = rtrim($queryValue, ',');
        $query .= $queryValue;
        $this->koneksi->query($query);
    }
}
