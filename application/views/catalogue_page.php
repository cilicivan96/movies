<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<script src="<?= base_url()?>assets/js/catalogue.js"></script>

<br />
<h1>Movie Catalogue</h1>
<br/>
<table class="table" id="table">
    <thead>
        <tr>
            <th scope="col">Poster</th>
            <th scope="col">Movie</th>
            <th scope="col">Rating</th>
            <th scope="col">Weighted Rating</th>
            <th scope="col">Release Date</th>
            <?php if ($this->session->userdata('logged_in') == 'true') { ?>
            <th scope="col">Favorite</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($movies as $row) { ?>
            <tr>
                <td style="max-width: 200px;">
                    <img src="<?= base_url() . 'assets/imgs/movies/' . $row->url_pic ?>" height="200px" class="img-fluid">
                </td>
                <td width="300px">
                    <a href="<?= base_url() . 'movie/getmovie/' . $row->id ?>"><?= $row->title ?></a>
                    <br />
                    <br />
                    <p><?= $row->desc ?></p>
                    <br />
                    <a href="<?= $row->url_imdb ?>">IMDB link</a>
                </td>
                <td>
                    <p><?= round($row->ri, 2) ?></p>
                    <br/>
                    <p>Number of ratings: <?= $row->ni ?></p>
                </td>
                <td><?php 
                $ni = $row->ni;
                $ri = $row->ri;
                $weighted = ($N*$R + $ni*$ri) / ($N + $ni);
                echo round($weighted, 5);
                ?></td>
                <td><?= $row->date ?></td>
                <?php if ($this->session->userdata('logged_in') == 'true') { ?>
                <td><i class="
                <?php 
                if(in_array($row->id, $favorites)) {
                    echo 'fas';
                } else {
                    echo 'far';
                } ?> fa-star favorite" onclick="favorite(this, <?= $row->id ?>)"></i></td>
                <?php } ?>
            </tr>
        <?php } ?>
</table>
</br>