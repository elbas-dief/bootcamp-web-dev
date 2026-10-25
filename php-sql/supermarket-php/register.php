<?php 

require __DIR__ . '/templates/header.php';

?>

<form action="/proses/proses-registrasi.php" class="container" method="post">
    <div class="d-flex mb-3">
        <label for="fullname" class="col-3 p-2">Nama Lengkap</label>
        <input type="text" name="fullname" id="fullname" placeholder="Input Your Fullname" class="form-control">
    </div>
    <div class="d-flex mb-3">
        <label for="username" class="col-3 p-2">Username</label>
        <input type="text" name="username" id="username" placeholder="Input Your Username" class="form-control">
    </div>
    <div class="d-flex mb-3">
        <label for="password" class="col-3 p-2">Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php
require __DIR__ . '/templates/footer.php';

 ?>