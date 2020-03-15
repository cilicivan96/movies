<br />
<div class = "text-center">
    <a href="<?= base_url().'catalogue' ?>">
        <img src="<?= base_url() . 'assets/imgs/general/logo_black.png' ?>" alt="" class = "img-fluid">
    </a>
</div>
<hr />
<form action="<?= base_url(); ?>login/doLogin" method="post">
    <?php if ($this->session->flashdata('msg')) { ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('msg'); ?>
        </div>
        <br />
    <?php } ?>
    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-warning">
            <?= $this->session->flashdata('error'); ?>
        </div>
        <br />
    <?php } ?>
    <div class="form-group">
        <label for="id">Id:</label>
        <input type="number" name="id" required class="form-control" id="id">
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" name="password" required class="form-control" id="pwd">
    </div>
    <div class = "text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<br/>
<br/>
<div class = "text-center">
    <h3>Not registered yet?</h3>
    <a href="<?= base_url() . 'register'; ?>" class="btn btn-dark">Register</a>
</div>
<br/>
<br/>