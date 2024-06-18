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
        $y1 = $data['y2'];
        $y2 = $data['y2'];
        $y3 = $data['y3'];
        $y4 = $data['y4'];
        $y5 = $data['y5'];
        $y6 = $data['y6'];
        $y7 = $data['y7'];
        $y8 = $data['y8'];
        $y9 = $data['y9'];

        $query = "INSERT INTO $this->table (x, y1, y2, y3, y4, y5, y6, y7, y8, y9) VALUES ('$x', '$y1', '$y2', '$y3', '$y4', '$y5', '$y6', '$y7', '$y8', '$y9')";
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
        $y1 = $data['y2'];
        $y2 = $data['y2'];
        $y3 = $data['y3'];
        $y4 = $data['y4'];
        $y5 = $data['y5'];
        $y6 = $data['y6'];
        $y7 = $data['y7'];
        $y8 = $data['y8'];
        $y9 = $data['y9'];

        $query = "UPDATE $this->table SET x = '$x', y1 = '$y1', y2 = '$y2', y3 = '$y3', y4 = '$y4', y5 = '$y5', y6 = '$y6', y7 = '$y7', y8 = '$y8', y9 = '$y9' WHERE id = $id";
        $this->koneksi->query($query);
    }

    public function import($data)
    {
        $query = "INSERT INTO $this->table (x, y1, y2, y3, y4, y5, y6, y7, y8, y9) VALUES ";
        $queryValue = "";
        for ($i = 0; $i < count($data); $i++) {
            $x = $data[$i]['x'];
            $y1 = $data[$i]['y1'];
            $y2 = $data[$i]['y2'];
            $y3 = $data[$i]['y3'];
            $y4 = $data[$i]['y4'];
            $y5 = $data[$i]['y5'];
            $y6 = $data[$i]['y6'];
            $y7 = $data[$i]['y7'];
            $y8 = $data[$i]['y8'];
            $y9 = $data[$i]['y9'];

            $queryValue .= "('$x', '$y1', '$y2', '$y3', '$y4', '$y5', '$y6', '$y7', '$y8', '$y9'),";
        }
        $queryValue = rtrim($queryValue, ',');
        $query .= $queryValue;
        $this->koneksi->query($query);
    }
}
