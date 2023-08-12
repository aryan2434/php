<?php
include('./resourses/database.php');
// includinf database and header file
include('./resourses/header.php');

$errors = [];
$name = $age = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $age = $_POST['age'];

    // Validate form data
    if (empty($name) || empty($age)) {
        $errors[] = "Name and age are required.";
    } else {
        // Insert friend list data into the database
        $sql = "INSERT INTO friendlist (Name, Age) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $age]);

        // Redirect back to the friend list page
        header('Location: friendlist.php');
        exit();
    }
}
?>
<!-- form for adding friend -->
<div class="container mt-5">
    <h2 class="mb-4">Add Friend</h2>
    <form method="post" action="addfriend.php">
        <div class="form-group">
            <!-- formfields -->
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" required>
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" class="form-control" id="age" name="age" value="<?= $age ?>" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Add Friend</button>
        </div>
    </form>
    <!-- error handling -->
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
<!-- insert footer -->
<?php include('./resourses/footer.php'); ?>
