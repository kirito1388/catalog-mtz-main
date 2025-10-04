<?php
require 'db_mtz.php';

if (isset($_POST['title']) && $_POST['title'] != '') {
    $title = $_POST['title'];
    $mysqli->query("INSERT INTO items_mtz (title) VALUES ('$title')");
    header('Location: index.php');
    exit;
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $mysqli->query("DELETE FROM items_mtz WHERE id=$id");
    header('Location: index.php');
    exit;
}

$result = $mysqli->query("SELECT id, title, created_at FROM items_mtz ORDER BY created_at DESC LIMIT 10");
$count = $mysqli->query("SELECT COUNT(*) AS c FROM items_mtz")->fetch_assoc()['c'];
?>
<!-- اچ تی ام ال پروژه -->
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>My List – mtz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>My List – mtz</h1>
        <h3>items_mtz</h3>
        <form method="post">
            <input type="text" name="title" placeholder="عنوان آیتم">
            <button type="submit">ثبت</button>
        </form>
        <table>
            <tr>
                <th>عنوان</th>
                <th>تاریخ ثبت</th>
                <th>عملیات</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td><a href="?delete=<?php echo $row['id']; ?>">حذف</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <p>تعداد کل آیتم‌ها: <?php echo $count; ?></p>
    </div>
</body>
</html>
