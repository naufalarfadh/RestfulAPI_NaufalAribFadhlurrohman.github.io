<?php
require_once "koneksi.php";
class Cake
{
    //fungsi get data
    public function get_cakes()
    {
        global $koneksi;
        $query = "SELECT * FROM cakess";
        $data = array();
        $result = $koneksi->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Get List Cake Successfully.',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function get_cake($id = 0){
        global $koneksi;
        $query = "SELECT * FROM cakess";
        if ($id != 0) {
        $query .= " WHERE id=" . $id . " LIMIT 1";
    }
    $data = array();
    $result = $koneksi->query($query);
    while ($row = mysqli_fetch_object($result)) {
        $data[] = $row;
    }
    $response = array(
        'status' => 1,
        'message' => 'Get Cake Successfully.',
        'data' => $data
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}
//insert cake data
public function insert_cake(){
    global $koneksi;
    $arrcheckpost = array('typecakes' => '', 'price' => '', 'qty' => '');
    $hitung = count(array_intersect_key($_POST, $arrcheckpost));
    if ($hitung == count($arrcheckpost)) {
        $result = mysqli_query($koneksi, "INSERT INTO cakess SET
        typecakes = '$_POST[typecakes]',
        price = '$_POST[price]',
        qty = '$_POST[qty]'");
        if ($result) {
            $response = array(
                'status' => 1,
                'message' => 'Cake Added Successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Cake Addition Failed.'
            );
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Parameter Do Not Match'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
function update_cake($id)
{
    global $koneksi;
    $arrcheckpost = array('typecakes' => '', 'price' => '', 'qty' => '');
    $hitung = count(array_intersect_key($_POST, $arrcheckpost));
    if ($hitung == count($arrcheckpost)) {
        $result = mysqli_query($koneksi, "UPDATE cakess SET
        typecakes = '$_POST[typecakes]',
        price = '$_POST[price]',
        qty = '$_POST[qty]'
        WHERE id='$id'");
        if ($result) {
            $response = array(
                'status' => 1,
                'message' => 'Cake Updated Successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Cake Updation Failed.'
            );
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Parameter Do Not Match'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
//delete cake data
function delete_cake($id){
    global $koneksi;
    $query = "DELETE FROM cakess WHERE id=" . $id;
    if (mysqli_query($koneksi, $query)) {
        $response = array(
            'status' => 1,
            'message' => 'Cake Deleted Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Cake Deletion Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
}