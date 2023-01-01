<div class="row">
    <div class="col-12 my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 ">
            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                <h6 class=" text-white text-capitalize ps-3"><?= $title  ?></h6>
                <a type="button" href="<?= base_url() ?>spp/bulanan" class="btn btn-sm btn-dark m-0 me-4">Back</a>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-4">
                <h6>Form</h6>
                <form action="<?= base_url() ?>spp/tambah_bulanan" method="post">
                    <input type="hidden" name="id_santri" id="id_santri">
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="ket" name="ket">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="text" class="form-control" id="jumlah" name="jumlah">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2" id="save">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <span type="button" class="badge badge-sm bg-gradient-success" id="all">All</span>
                <span type="button" class="badge badge-sm bg-gradient-success" id="aktif">Aktif</span>
                <span type="button" class="badge badge-sm bg-gradient-secondary" id="non">Non</span>

                <div class="table-responsive p-0">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">check</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">nama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">check</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php $no = 0;
                                foreach ($santri->result() as $key) : ?>

                                    <td>
                                        <input type="checkbox" id="id<?= $key->id_santri ?>" class="id_santri status<?= $key->status ?>" value="<?= $key->id_santri ?>">
                                    </td>
                                    <td>
                                        <?= $key->nama ?>
                                    </td>
                                    <?php if ($no % 2 != 0) {
                                        echo '</tr>
                                                <tr>';
                                    } ?>
                                <?php $no++;
                                endforeach  ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function santri() {
        var jumlah = $('.id_santri').length;
        var id = '';
        for (let i = 0; i < jumlah; i++) {
            if ($('.id_santri')[i].checked == true) {
                id += $('.id_santri')[i].value;
                id += ',';
            }
        }
        $('#id_santri').val(id.slice(0, -1));
    }
    $('#all').on('click', function() {
        if ($('.id_santri:checked').length != $('.id_santri').length) {
            $('.id_santri').prop('checked', true);
        } else {
            $('.id_santri').prop('checked', false);
        }
        santri();
    });
    $('#aktif').on('click', function() {
        if ($('.status0:checked').length != $('.status0').length) {
            $('.status0').prop('checked', true);
        } else {
            $('.status0').prop('checked', false);
        }
        santri();
    });
    $('#non').on('click', function() {
        if ($('.status1:checked').length != $('.status1').length) {
            $('.status1').prop('checked', true);
        } else {
            $('.status1').prop('checked', false);
        }
        santri();
    });
    $('.id_santri').on('change', function() {
        santri();
    });
</script>