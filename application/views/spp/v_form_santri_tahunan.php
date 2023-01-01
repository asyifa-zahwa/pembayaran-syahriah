<div class="modal fade show" id="modal_form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog bg-dark modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Data Santri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <button class="btn btn-sm btn-success" id="all">Check</button>
                <button class="btn btn-sm btn-success" id="aktif">Aktif</button>
                <button class="btn btn-sm btn-secondary" id="non">Non</button>

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
                <form action="<?= base_url() ?>spp/tambahsantri_tahunan/<?= $id_spp_tahunan?>/<?= $jumlah ?>" method="post">
                    <input type="hidden" name="id_santri" id="id_santri_0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
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
        $('#id_santri_0').val(id.slice(0, -1));
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