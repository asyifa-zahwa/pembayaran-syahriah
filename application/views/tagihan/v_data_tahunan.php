<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <!-- <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between"> -->
                    <nav class="navbar navbar-expand-lg bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                    
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                          
                          <li class="nav-item">
                            <a type="button" class="btn btn-sm btn-info m-0 me-4" href="<?= base_url() ?>tagihan/bulanan">Bulanan</a>
                          </li>
                          <li class="nav-item">
                            <a type="button" class="btn btn-sm btn-warning disabled m-0 me-4" href="<?= base_url() ?>tagihan/tahunan">Tahunan</a>
                          </li>
                          <li class="nav-item">
                            <a type="button" class="btn btn-sm btn-info m-0 me-4" href="<?= base_url() ?>tagihan">Tambahan</a>
                          </li>

                        </ul>
                       <!--  <form class="form-inline my-2 my-lg-0">
                          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form> -->

                      </div>
                      <a type="button" href="<?= base_url() ?>tagihan/excel_tahunan" class="btn btn-sm btn-dark m-0 me-4">
                        export
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tagihan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bayar</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tunggakan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                <th colspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = $this->uri->segment('3') + 1;
                            foreach ($tagihan->result() as $key) :
                                $total_bayar = $this->db->select('sum(gross_amount) as total_bayar')->where(['id_santri' => $key->id_santri, 'status_code' => 200])->get('tb_bayar_tahunan')->row()->total_bayar;
                                $santri = $this->db->select('nama')->where(['id_santri' => $key->id_santri])->get('tb_santri')->row()->nama;  ?>

                                <tr>
                                    <td class="text-center">
                                        <?= $no++ ?>
                                    </td>
                                    <td>
                                        <?= $santri ?>
                                    </td>
                                    <td>
                                        <?= "Rp " . number_format($key->jumtung, 0, ',', '.'); ?>
                                    </td>
                                    <td>
                                        <?= "Rp " . number_format($total_bayar, 0, ',', '.'); ?>
                                    </td>
                                    <td>
                                        <?= "Rp " . number_format($key->jumtung - $total_bayar, 0, ',', '.'); ?>
                                    </td>
                                    <td>
                                        <?php if ($key->jumtung <= $total_bayar) { ?>
                                            <span type="button" class="badge badge-sm bg-gradient-success"  onclick="bayar('<?= $key->id_santri ?>', '<?= $santri ?>', '<?= $key->jumtung - $total_bayar ?>')">Lunas</span>
                                        <?php } else { ?>
                                            <span type="button" class="badge badge-sm bg-gradient-info" onclick="bayar('<?= $key->id_santri ?>', '<?= $santri ?>', '<?= $key->jumtung - $total_bayar ?>')">Bayar</span>
                                        <?php } ?>

                                    </td>
                                    <td>
                                        <a href="<?= base_url() ?>tagihan/detail_tahunan/<?= $key->id_santri ?>"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <!-- <td>
                                        <a href="#" onclick="hapus('<?= base_url() ?>tagihan/hapus2/<?= $key->id_santri ?>', 'Apakah Anda Ingin Menghapus Semua Tagihan <?= $key->nama_santri ?>  ..?')"><i class="fa fa-trash"></i></a>
                                    </td> -->
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

<div class="modal fade" id="modal_bayar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bayarLabel">Form Pembayaran <span id="namasantri" class="text-info"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_bayar">
                    <h6>Jumlah Tunggakan : Rp. <span id="tunggakan"></span></h6>
                    <div class="input-group input-group-outline mb-3">
                        <label for="bayar" class="form-label">Bayar</label>
                        <input type="number" class="form-control" name="bayar" id="bayar">
                    </div>
                    <br>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function bayar(id_santri, nama, tunggakan) {
        $('#modal_bayar').modal('show');
        $('#form_bayar').attr('action', '<?= base_url() ?>tagihan/bayar_tahunan/' + id_santri);
        $('#namasantri').html(nama);
        $('#tunggakan').html(tunggakan);
        $('#bayar').val('');
        $('#bayar').attr('onkeyup', 'maxval(' + tunggakan + ')');
        $('#bayar').attr('onchange', 'maxval(' + tunggakan + ')');
    }
</script>