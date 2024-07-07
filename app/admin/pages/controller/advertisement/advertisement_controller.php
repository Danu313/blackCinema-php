<?php
include('conn.php');
function getAllAdvertisements()
{
    global $conn;
    $sql = "SELECT * FROM advertisement";
    $result = $conn->query($sql);

    $advertisements = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $advertisements[] = $row;
        }
    }
    return $advertisements;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($_GET['action']) && $_GET['action'] === 'add') {
        $link = $data['image'];

        $sql = "INSERT INTO advertisement (links) VALUES ('$link')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false));
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];

    $sql = "DELETE FROM advertisement WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false));
    }
}
