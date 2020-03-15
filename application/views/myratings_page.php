<script src="<?= base_url()?>assets/js/myratings.js"></script>

<br/>
<div id="recommend">
    <button class="btn btn-danger" type="button" id="getrecs"
    onclick="buttonPressed()"> Generate Recommendations</button>
    <a type="button" id="showrecs" class="btn btn-primary" type="button" style="display: none"
    href="<?= base_url() . 'recommendation/showrecs' ?>"> See Recommendations</a>
</div>
<br/> <br/>

<div id="myratings">
<h1>My Ratings</h1>
<br/>
<table class="table" id="table">
    <thead>
        <tr>
            <th scope="col">Poster</th>
            <th scope="col">Movie</th>
            <th scope="col">Your Rating</th>
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
                </td>
                <td>
                    <p><?= $row->score ?></p>
                </td>
            </tr>
        <?php } ?>
</table>
</div>
</br>