<link rel="stylesheet" href="<?= base_url() . 'assets/css/general/movie.css' ?>">
<script src="<?= base_url()?>assets/js/movie.js"></script>
<br/>
<div class="movie_data">
    <table>
        <tr>
            <td>
                <img src = "<?= base_url() . 'assets/imgs/movies/' .$movie_genre[0]->url_pic ?>" 
                class = "border border-secundary rounded">
            </td>
            <td>
                <h3><?= $movie_genre[0]->title ?></h3>
                <br/>
                <?= $movie_genre[0]->desc ?>
                <br/>
                <br/>
                <h5>Genre</h5>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <?php foreach($movie_genre as $row) { ?>
                    <button type="button" class="btn btn-secondary"><?= $row->name ?></button>
                    <?php } ?>
                </div>
                <br/>
                <br/>
                <?php if ($this->session->userdata('logged_in') == 'true') { ?>
                <h5>Your rating</h5>
                <div class="btn-group" role="group" aria-label="Basic example" id="ratings">
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <button type="button" class="btn btn-info 
                        <?php 
                        if(isset($user_rating) & $user_rating == $i) echo 'active';
                        ?>" onclick="buttonPressed(this, <?= $i ?>, <?= $movie_genre[0]->movie_id ?>)">
                        <?= $i ?></button>
                    <?php } ?>
                </div>
                <?php } ?>
            </td>
        </tr>
    </table>
</div>
<br/>
<br/>
<h3>Comments</h3>
<div class="comments">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">User Name</th>
                <th scope="col">Comment</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($comments)) {
                foreach($comments as $com) { ?>
                <tr>
                    <td><?= $com->name ?></th>
                    <td><?= $com->comment ?></th>
                </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</div>
<br/>
<?php if ($this->session->userdata('logged_in') == 'true') { ?>
<form action="<?= base_url(); ?>movie/addcomment" method="post">
    <input type="hidden" name="id_movie" value="<?= $movie_genre[0]->movie_id ?>">
    <div class="form-group blue-border-focus">
        <label for="com_text"><b>Write your comment:</b></label>
        <textarea class="form-control" name="com_text" id="com_text" rows="3"></textarea>
    </div>
    <div class = "text-left">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<br/>
<?php } ?>
