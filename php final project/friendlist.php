<?php
// Include necessary files and configurations
include('./resourses/database.php');
include('./resourses/header.php');



// Fetch friend list data from the database
$sql = "SELECT * FROM friendlist";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$friends = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- first line of table -->
<div class="container mt-5">
    <h2 class="mb-4">Friend List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- displaying table -->
            <?php foreach ($friends as $friend) : ?>
                <tr>
                    <td><?= $friend['ID'] ?></td>
                    <td><?= $friend['Name'] ?></td>
                    <td><?= $friend['Age'] ?></td>
                    <td>
                        <!-- btn to edit and remove friends -->
                        <a href="editfriend.php?id=<?= $friend['ID'] ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="deletefriend.php?id=<?= $friend['ID'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- btn for add friend and logout -->
    <div class="mt-3">
        <a href="addfriend.php" class="btn btn-success">Add Friend</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>
<!-- insert footer -->
<?php include('./resourses/footer.php'); ?>
