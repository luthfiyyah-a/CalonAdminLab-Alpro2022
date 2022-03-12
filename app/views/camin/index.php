<div class="container mt-5">

    <div class="row">
        <col-6>
            <h3>Daftar Calon Admin</h3>
            <ul class="list-group">
                <?php foreach( $data['mhs'] as $mhs ) : ?>
                    <li class="list-group-item  d-flex justify-content-between align-items-start">
                        <?= $mhs['nama']; ?>
                        <a href="<?= BASEURL; ?>/camin/detail/<?= $mhs['id']?>" class="badge bg-primary">detail</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </col-6>
    </div>

</div>