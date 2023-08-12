<?php
// Include necessary files and configurations
include('./resourses/database.php');
include('./resourses/header.php');

$errors = [];
$name = $age = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];

    // Validate form data
    if (empty($name) || empty($age)) {
        $errors[] = "Name and age are required.";
    } else {
        // Update friend data in the database
        $sql = "UPDATE friendlist SET Name = ?, Age = ? WHERE ID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $age, $id]);

        // Redirect back to the friend list page
        header('Location: friendlist.php');
        exit();
    }
} elseif (isset($_GET['id'])) {
    // data for pre-filling the form
    $id = $_GET['id'];
    $sql = "SELECT * FROM friendlist WHERE ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $friend = $stmt->fetch();

    if ($friend) {
        $name = $friend['Name'];
        $age = $friend['Age'];
    } else {
        //  if Friend not found, redirect to the friend list page
        header('Location: friendlist.php');
        exit();
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Edit Friend</h2>
    <!-- form for edit friend -->
    <form method="post" action="editfriend.php">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" required>
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" class="form-control" id="age" name="age" value="<?= $age ?>" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Friend</button>
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
