<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <!-- <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between"> -->
                    <nav class="navbar navbar-expand-lg bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                          
                          <li class="nav-item">
                            <a type="button" class="btn btn-sm btn-warning disabled m-0 me-4" href="<?= base_url() ?>spp/bulanan">Bulanan</a>
                          </li>
                          <li class="nav-item">
                            <a type="button" class="btn btn-sm btn-info m-0 me-4" href="<?= base_url() ?>spp/tahunan">Tahunan</a>
                          </li>
                          <li class="nav-item">
                            <a type="button" class="btn btn-sm btn-info m-0 me-4" href="<?= base_url() ?>spp">Tambahan</a>
                          </li>

                        </ul>
                       <!--  <form class="form-inline my-2 my-lg-0">
                          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form> -->

                      </div>
                      <a type="button" href="<?= base_url() ?>spp/form_bulanan" class="btn btn-sm btn-info m-0 me-4">
                        Tambah
                    </a>
                    </nav>
                    
                <!-- </div> -->
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Keterangan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Di Buat</th>
                                <th colspan="4" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = $this->uri->segment('3')+1;
                            foreach ($spp->result() as $key) : ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $no++ ?>
                                    </td>
                                    <td>
                                        <?= $key->ket ?>
                                    </td>
                                    <td>
                                        <?= "Rp " . number_format($key->jumlah, 0, ',', '.'); ?>
                                    </td>
                                    <td>
                                        <?= $key->created_at ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url() ?>spp/detail_bulanan/<?= $key->id_spp_bulanan ?>"><i class="fa fa-eye"></i></a>
                                    </td>
                                  <!--   <td>
                                        <a href="#" onclick="tambah('<?= $key->id_spp_bulanan ?>', '<?= $key->jumlah ?>')"><i class="fa fa-plus"></i></a>
                                    </td> -->
                                    <td>
                                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="edit('<?= $key->id_spp_bulanan ?>','<?= $key->ket ?>','<?= $key->jumlah ?>')"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <a href="#" onclick="hapus('<?= base_url() ?>spp/hapus_bulanan/<?= $key->id_spp_bulanan ?>', 'Apakah Anda Ingin Menghapus ..?')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <br>
                    <?= $this->pagination->create_links();?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog bg-dark">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form SPP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_spp">
                    <input type="hidden" name="id_santri" id="id_santri">
                    <div class="input-group input-group-outline my-3 is-filled">
                        <label class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="ket" name="ket">
                    </div>
                    <div class="input-group input-group-outline mb-3 is-filled">
                        <label class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah">
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="santri">

</div>
<script>
   // function tambah(id_spp_bulanan, jumlah) {
   //     $('#santri').html('');
   //     $.ajax({
    //        url: '<?php echo base_url(); ?>/spp/formsantri/' + id_spp_bulanan + '/' + jumlah,
    //        success: function(data) {
   //             $('#santri').html(data);
   //             $('#modal_form').modal('show');
   //         }
   //     });
   // }


    function edit(id, ket, jumlah) {
        $('#form_spp').attr('action', '<?= base_url() ?>spp/update_bulanan/' + id);
        $('#ket').val(ket);
        $('#jumlah').val(jumlah);
    }
</script>