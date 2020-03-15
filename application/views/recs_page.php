<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<script src="<?= base_url()?>assets/js/recs.js"></script>

<br />
<h1>Recommendations</h1>
<br/>
<table class="table" id="table">
    <thead>
        <tr>
            <th scope="col">Movie</th>
            <th scope="col">Predicted Rating</th>
            <?php if ($this->session->userdata('logged_in') == 'true') { ?>
            <th scope="col">Favorite</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($recs as $row) { ?>
            <tr>
                <td width="300px">
                    <a href="<?= base_url() . 'movie/getmovie/' . $row->id ?>"><?= $row->title ?></a>
                    <br />
                    <br />
                    <p><?= $row->desc ?></p>
                    <br />
                </td>
                <td><p><?= round($row->rec_score, 5) ?></p></td>
                <?php if ($this->session->userdata('logged_in') == 'true') { ?>
                <td><i class="
                <?php 
                if ($row->id_user != null) {
                    echo 'fas';
                } else {
                    echo 'far';
                } ?> fa-star favorite" onclick="favorite(this, <?= $row->id ?>)"></i></td>
                <?php } ?>
            </tr>
        <?php } ?>
</table>
</br>