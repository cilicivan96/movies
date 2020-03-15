<link rel="stylesheet" href="<?= base_url() . 'assets/css/general/userprofile.css' ?>">

<br/>
<?php if ($this->session->flashdata('error')) { ?>
    <div class="alert alert-warning">
        <?= $this->session->flashdata('error'); ?>
    </div>
    <br />
<?php } ?>
<?php if ($this->session->flashdata('msg')) { ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('msg'); ?>
    </div>
	<br />
<?php } ?>

<div class="user_data">
    <table>
        <tr>
            <td>
                <img src="
                <?php 
                $src = base_url() . 'assets/imgs/users/';
                if($user->pic != "") {
                    $src = $src . $user->pic;
                } else {
                    $src = $src . 'blank.png';
                }
                echo $src; ?>" class = "img-fluid border border-secundary rounded">
            </td>
            <td>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th scope="row" class ="text-center">Name</th>
                            <td>
                                <div class="text-center"> 
                                    <button type="button" class="btn btn-dark"><?= $user->name ?></button>    
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class ="text-center">ID</th>
                            <td>
                                <div class="text-center">
                                    <button type="button" class="btn btn-dark"><?= $user->id ?></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class ="text-center">Age</th>
                            <td>
                                <div class="text-center">
                                    <button type="button" class="btn btn-dark"><?= $user->edad ?></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class ="text-center">Sex</th>
                            <td>
                                <div class="text-center">
                                    <button type="button" class="btn btn-dark"><?= $user->sex ?></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class ="text-center">Occupation</th>
                            <td>
                                <div class="text-center">
                                    <button type="button" class="btn btn-dark"><?= $user->ocupacion ?></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </br>
                
                <div class="text-center">
                    <a href="<?= base_url(); ?>userprofile/editprofile" 
                    class="btn btn-info">Edit My Profile</a>
                </div>
                <br />
                <div class="text-center">
                    <button type="button" class="btn btn-warning" id="opener">Favorites</button>
                </div>
            </td>
        </tr>
    </table>
</div>
<br/>
<br/>

<div class="form-group form-inline" id="gettop">
    <h2>Top rated movies by (genre) &nbsp;</h2>
    <select class="form-control input-lg" id="toplist">
        <?php foreach($genre as $row) { ?>
        <option name="genre" value="<?= $row->id ?>"><?= $row->name ?></option>
        <?php } ?>
    </select>
    <h2>&nbsp;</h2>
    <button type="submit" class="btn btn-secondary" onclick="toprated()">Submit</button>
</div>

<table class="table" id="top" style="display: none">
</table>

<div id="dialog" title="Favorite Movies" class="cod">
    <ul>
        <?php foreach ($favorites as $row) { ?>
        <li><a href="<?= base_url() . 'movie/getmovie/' . $row->id ?>"><?= $row->title ?></a></li>
        <?php } ?>
    </ul>
</div>
<br/>
<script src="<?= base_url()?>assets/js/userprofile.js"></script>