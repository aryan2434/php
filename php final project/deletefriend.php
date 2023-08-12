<?php
// Include necessary files and configurations
include('./resourses/database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete friend data from the database
    $sql = "DELETE FROM friendlist WHERE ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

// Redirect back to the friend list page
header('Location: friendlist.php');
exit();
?>
