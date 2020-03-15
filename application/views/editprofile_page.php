<br />
<form action="<?= base_url(); ?>userprofile/updatedata" method="post" enctype="multipart/form-data">
    <h2>Edit Profile</h2>
    <hr />
    <?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-danger">
            <?=$this->session->flashdata('errors'); ?>
        </div>
    <?php } ?>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" required class="form-control" id="name" value="<?= $user->name ?>">
    </div>
    <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" name="age" required class="form-control" id="age" value="<?= $user->edad ?>">
    </div>
    <div class="form-group">
        <p>Sex:</p>
        <label class="radio-inline">
            <input type="radio" name="sex" value="M" required class="form-control" id="sex_M" 
            <?php if ($user->sex == 'M') echo 'checked'?>>Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="sex" value="F" required class="form-control" id="sex_F"
            <?php if ($user->sex == 'F') echo 'checked'?>>Female
        </label>
    </div>
    <div class="form-group">
        <label for="occupation">Occupation:</label>
        <select class="form-control" id="occupation" name="occupation">
            <?php $list = array('administrator', 'artist', 'doctor', 'educator', 'engineer', 'entertainment', 'executive', 
            'healthcare', 'homemaker', 'lawyer', 'librarian', 'marketing', 'none', 'other', 'programmer',
            'retired', 'salesman', 'scientist', 'student', 'technician', 'writer'); 
            foreach($list as $val) { 
                if($val == $user->ocupacion) {
                    echo '<option selected>' . $val . '</option>';
                } else {
                    echo '<option>' . $val . '</option>';
                }  
            } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" required class="form-control" id="password">
    </div>
    <div class="form-group">
        <label for="img">Profile photo:</label>
        <input type="file" name="img" required class="form-control" id="img">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <span class="float-right"><a href="<?= base_url() . 'userprofile'; ?>" class="btn btn-danger">Cancel</a></span>
</form>
<br/>