<?php
$show = true;
$role = "userr";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing conditional</title>
</head>

<body>
    <h1>There is hidden text in this page</h1>

    <?php if ($role == 'admin'): ?>
        <p>This is the hidden text</p>
        <h1>Test</h1>
    <?php endif; ?>

    <?php if ($role == 'admin'): ?>
        <p>Kamu admin</p>
    <?php elseif($role == 'user'): ?>
        <p>Kamu user</p>
    <?php else: ?>
        <p>Kamu bukan admin atau user</p>
    <?php endif ?>
</body>
</html>