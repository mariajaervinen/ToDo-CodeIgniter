<h3><?= $title ?></h3>
<form action="/check">
    <div class="col-12">
    <?= \Config\Services::validation()->listErrors(); ?>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input class="form-control"
        name="user" placeholder ="Enter username"
        maxlength="30">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input class="form-control"
        name="password" type="password" placeholder ="Enter password"
        maxlength="30">
    </div>
    <button class="btn btn-primary">Login</button>
    <?= anchor('login/register','Register') ?>
</form>