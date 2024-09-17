<?php
session_start();
include("database.php");

if ($_SESSION['roles'] != 'admin') {
    header('Location: home.php');
    exit();
}

$users_query = "SELECT * FROM account_info WHERE roles != 'admin'";
$users_result = mysqli_query($con, $users_query);

$announcement_query = "SELECT * FROM announcements ORDER BY id ASC LIMIT 3";
$announcement_result = mysqli_query($con, $announcement_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_announcement'])) {
        $announcement_content = mysqli_real_escape_string($con, $_POST['announcement']);
        if (!empty($announcement_content)) {

            $shift_query = "UPDATE announcements SET id = id + 1 ORDER BY id DESC";
            mysqli_query($con, $shift_query);

            $insert_query = "REPLACE INTO announcements (id, content, last_updated) VALUES (1, ?, NOW())";
            $stmt = $con->prepare($insert_query);
            $stmt->bind_param("s", $announcement_content);

            if ($stmt->execute()) {
                $delete_query = "DELETE FROM announcements WHERE id > 3";
                mysqli_query($con, $delete_query);

                $announcement_success = "Announcement updated successfully.";
            } else {
                $announcement_error = "Failed to update announcement.";
            }
        } else {
            $announcement_error = "Announcement content cannot be empty.";
        }
    } elseif (isset($_POST['update_user'])) {
        $user_id = $_POST['user_id'];
        $new_username = mysqli_real_escape_string($con, $_POST['username']);
        $new_email = mysqli_real_escape_string($con, $_POST['email']);
        $new_password = mysqli_real_escape_string($con, $_POST['password']);

        $check_email_query = "SELECT id FROM account_info WHERE email = '$new_email' AND id != $user_id";
        $check_email_result = mysqli_query($con, $check_email_query);

        if (mysqli_num_rows($check_email_result) > 0) {
            $edit_error = "Email already exists. Please use a different email.";
        } else {
            $update_user_query = "UPDATE account_info SET username = ?, email = ?, password = ? WHERE id = ?";
            $stmt = $con->prepare($update_user_query);
            $stmt->bind_param("sssi", $new_username, $new_email, $new_password, $user_id);

            if ($stmt->execute()) {
                $edit_success = "User updated successfully.";
                echo "<script>alert('User updated successfully.');</script>";
            } else {
                $edit_error = "Failed to update user.";
                echo "<script>alert('Failed to update user.');</script>";
            }
        }
    } elseif (isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];
        $delete_user_query = "DELETE FROM account_info WHERE id = ?";
        $stmt = $con->prepare($delete_user_query);
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            $delete_success = "User deleted successfully.";
            echo "<script>alert('User deleted successfully.');</script>";
        } else {
            $delete_error = "Failed to delete user.";
            echo "<script>alert('Failed to delete user.');</script>";
        }
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="adminstyle.css">
<div class="navbar">
    Welcome to the Admin Panel
    <a href="admin.php?logout=true" class="logout-button">Logout</a>
</div>

<div class="container">

    <h2>Announcement Management</h2>
    <?php if (isset($announcement_success)) { ?>
        <div class="success-message"><?php echo $announcement_success; ?></div>
    <?php } elseif (isset($announcement_error)) { ?>
        <div class="error-message"><?php echo $announcement_error; ?></div>
    <?php } ?>

    <form action="admin.php" method="post" class="announcement-form">

        <textarea id="announcement" name="announcement" rows="5" cols="60"></textarea>
        <button type="submit" name="update_announcement">Add Announcement</button>
    </form>

    <h3>Previous Announcements</h3>
    <div class="announcement-history">
        <?php while ($row = mysqli_fetch_assoc($announcement_result)) { ?>
            <div class="announcement-item">
                <p><strong>Date:</strong> <?php echo htmlspecialchars($row['last_updated']); ?></p>
                <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
            </div>
        <?php } ?>
    </div>

    <h2>User Management</h2>
    <input type="text" id="search-bar" placeholder="Search by username or email">
    <table class="user-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th> 
                <th>Total Time Spent</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="user-table-body">
            <?php while ($row = mysqli_fetch_assoc($users_result)) { ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['password']; ?></td> 
                    <td><?php echo gmdate("H:i:s", $row['total_time_spent']); ?></td>
                    <td class="actions">
                        <a href="#" class="edit-button" data-id="<?php echo $row['id']; ?>" data-username="<?php echo $row['username']; ?>" data-email="<?php echo $row['email']; ?>" data-password="<?php echo $row['password']; ?>">Edit</a>
                        <a href="#" class="delete-button" data-id="<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2>Total Time Spent</h2>
    <table class="user-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Total Time Spent</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_time = 0;
            mysqli_data_seek($users_result, 0);
            while ($row = mysqli_fetch_assoc($users_result)) {
                $total_time += $row['total_time_spent'];
                ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo gmdate("H:i:s", $row['total_time_spent']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h3>Total Time Spent by All Users: <?php echo gmdate("H:i:s", $total_time); ?></h3>

</div>

<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="admin.php" method="post">
            <input type="hidden" id="edit-user-id" name="user_id">
            <label for="username">Username:</label>
            <input type="text" id="edit-username" name="username" required>
            <label for="email">Email:</label>
            <input type="email" id="edit-email" name="email" required>
            <label for="password">Password:</label>
            <input type="text" id="edit-password" name="password" required> <!-- Input type text for password -->
            <button type="submit" name="update_user">Update User</button>
        </form>
    </div>
</div>

<form id="deleteForm" action="admin.php" method="post" style="display: none;">
    <input type="hidden" id="delete-user-id" name="user_id">
    <button type="submit" name="delete_user">Delete User</button>
</form>

<script>
    const editButtons = document.querySelectorAll('.edit-button');
    const editModal = document.getElementById('editModal');
    const closeModal = document.getElementsByClassName('close')[0];

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('edit-user-id').value = button.getAttribute('data-id');
            document.getElementById('edit-username').value = button.getAttribute('data-username');
            document.getElementById('edit-email').value = button.getAttribute('data-email');
            document.getElementById('edit-password').value = button.getAttribute('data-password');
            editModal.style.display = 'block';
        });
    });

    closeModal.onclick = function () {
        editModal.style.display = 'none';
    };

    window.onclick = function (event) {
        if (event.target == editModal) {
            editModal.style.display = 'none';
        }
    };

    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (confirm('Are you sure you want to delete this user?')) {
                document.getElementById('delete-user-id').value = button.getAttribute('data-id');
                document.getElementById('deleteForm').submit();
            }
        });
    });
</script>

</body>
</html>
