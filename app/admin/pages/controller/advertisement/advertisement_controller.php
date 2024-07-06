<?php
include('conn.php');

// Fetch all advertisements from database
// Function to get all advertisements from database
function getAllAdvertisements()
{
    global $conn;
    $query = "SELECT * FROM advertisement";
    $result = mysqli_query($conn, $query);
    $advertisements = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $advertisements[] = $row;
        }
        mysqli_free_result($result);
    } else {
        // Handle query error
        error_log("Database query failed: " . mysqli_error($conn));
    }
    return $advertisements;
}

// Action handler
if (isset($_GET['action']) && $_GET['action'] === 'getAll') {
    $advertisements = getAllAdvertisements();
    echo json_encode($advertisements);
    exit; // Stop further execution
}

// Function to add advertisement
function addAdvertisement($imagePath)
{
    global $conn;

    $query = "INSERT INTO advertisement (imagePath) VALUES (?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $imagePath);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return true;
    } else {
        error_log("Failed to insert advertisement: " . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        return false;
    }
}

// Function to update advertisement
function updateAdvertisement($id, $imagePath)
{
    global $conn;
    $id = intval($id);
    $imagePath = mysqli_real_escape_string($conn, $imagePath);
    $updateQuery = "UPDATE advertisement SET imagePath = '$imagePath' WHERE id = $id";
    return mysqli_query($conn, $updateQuery);
}

// Function to delete advertisement
function deleteAdvertisement($id)
{
    global $conn;
    $id = intval($id);
    $deleteQuery = "DELETE FROM advertisement WHERE id = $id";
    return mysqli_query($conn, $deleteQuery);
}

// Action handler
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $response = array('success' => false); // Default response

    switch ($action) {
        case 'add':
            // Add new advertisement
            if (isset($_POST['image'])) {
                $imagePath = $_POST['image'];
                $success = addAdvertisement($imagePath);
                if ($success) {
                    $response['success'] = true;
                }
            }
            break;

        case 'update':
            // Update existing advertisement
            if (isset($_POST['id']) && isset($_POST['image'])) {
                $id = $_POST['id'];
                $imagePath = $_POST['image'];
                $success = updateAdvertisement($id, $imagePath);
                if ($success) {
                    $response['success'] = true;
                }
            }
            break;

        case 'delete':
            // Delete advertisement
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $success = deleteAdvertisement($id);
                if ($success) {
                    $response['success'] = true;
                }
            }
            break;

        case 'getAll':
            // Get all advertisements
            $response = getAllAdvertisements();
            break;

        default:
            $response['message'] = 'Invalid action';
            break;
    }
    echo json_encode($response);
}
