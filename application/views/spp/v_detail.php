<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                    <div class="px-2 m-0 me-4">
                        <a type="button" href="<?= base_url() ?>spp" class="btn btn-sm btn-dark m-0">Back</a>
                    </div>
                    <h6 class=" text-white text-capitalize ps-3"><?= $title  ?> : <?= $detail->ket ?> | Jumlah : Rp.<?= number_format($detail->jumlah, 0) ?></h6>
                    <a type="button" href="#" class="btn btn-sm btn-info m-0 me-4" onclick="tambah('<?= $detail->id_spp ?>', '<?= $detail->jumlah ?>')">
                        Tambah
                    </a>
                    

                </div>
            </div>
            <div class="col-md-12 px-2 pb-0">
                <div class="table-responsive p-0">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                              <tr>
                                <?php $no = 1; foreach ($santri->result() as $key) :
                            $nama = $this->db->select('nama')->where(['id_santri' => $key->id_santri])->get('tb_santri')->row()->nama; ?>
                                    <td class="text-center">
                                        <?= $no++ ?>
                                    </td>
                                    <td>
                                        <?= $nama?>
                                    </td>
                                    <td>
                                        <a href="#" onclick="hapus('<?= base_url() ?>spp/hapustagihan/<?= $key->id_spp ?>/<?= $key->id_tagihan ?>', 'Apakah Anda Ingin Menghapus ..?')"><i class="fa fa-trash"></i></a>
                                    </td>
                                    <?php if ($no % 2 != 0) {
                                        echo '</tr>
                                                <tr>';
                                    } ?>
                                   <?php endforeach ?>
                              </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="santri">

</div>
<script>
    function tambah(id_spp, jumlah) {
        $('#santri').html('');
        $.ajax({
            url: '<?php echo base_url(); ?>spp/formsantri/' + id_spp + '/' + jumlah,
            success: function(data) {
                $('#santri').html(data);
                $('#modal_form').modal('show');
            }
        });
    }
</script>