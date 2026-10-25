<?php

require __DIR__ . '/templates/header.php';
require __DIR__ . '/config/koneksi.php';

if (isset($_SESSION['registrasi-sukses'])) { ?>
    <div class="alert alert-success">
        <?= $_SESSION['registrasi-sukses']; ?>
    </div>
<?php
    unset($_SESSION['registrasi-sukses']);
}
?>

<div class="login-container">
    <div class="login-card p-4">
        <h1>Login</h1>
        <form action="/proses/proses-login.php" method="post" class="d-flex row gap-3">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="d-flex col gap-3">
                <a href="/register.php" class="btn btn-outline-primary">Register</a>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>

<?php
require __DIR__ . '/templates/footer.php';
?>