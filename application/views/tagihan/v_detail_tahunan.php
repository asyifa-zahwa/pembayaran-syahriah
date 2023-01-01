<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <!-- <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                    <h6 class=" text-white text-capitalize ps-3"><?= $title  ?></h6>
                </div> -->
                <nav class="navbar navbar-expand-lg bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                    <div>
                        <a type="button" href="<?= base_url() ?>tagihan/tahunan" class="btn btn-sm btn-dark m-0 me-4">Back</a>
                    </div>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                          
                          <li class="nav-item">
                            <?php 
                            if ( isset($this->db->select('id_santri as id')->where(['id_santri' => $detail->row()->id_santri])->get('tb_tagihan_bulanan')->row()->id) ) : ?>
                            <a type="button" class="btn btn-sm btn-info m-0 me-4" href="<?= base_url() ?>tagihan/detail_bulanan/<?= $detail->row()->id_santri;?>">Bulanan</a>
                            <?php else : ?>
                            
                            <a type="button" class="btn btn-sm btn-info disabled m-0 me-4" href="<?= base_url() ?>tagihan/detail_bulanan/<?= $detail->row()->id_santri;?>">Bulanan</a> 
              
                             <?php endif?>
                          </li>
                          <li class="nav-item">
                          <?php 
                            if ( isset($this->db->select('id_santri as id')->where(['id_santri' => $detail->row()->id_santri])->get('tb_tagihan_tahunan')->row()->id) ) : ?>
                            <a type="button" class="btn btn-sm btn-warning disabled m-0 me-4" href="<?= base_url() ?>tagihan/detail_tahunan/<?= $detail->row()->id_santri;?>">Tahunan</a>
                            <?php else : ?>
                            
                            <a type="button" class="btn btn-sm btn-warning disabled m-0 me-4" href="<?= base_url() ?>tagihan/detail_tahunan/<?= $detail->row()->id_santri;?>">Tahunan</a> 

              
                             <?php endif?>
                          </li>
                          <li class="nav-item">
                            
                            <?php 
                            if ( isset($this->db->select('id_santri as id')->where(['id_santri' => $detail->row()->id_santri])->get('tb_tagihan')->row()->id) ) : ?>
                            <a type="button" class="btn btn-sm btn-info m-0 me-4" href="<?= base_url() ?>tagihan/detail/<?= $detail->row()->id_santri;?>">Tambahan</a>
                            <?php else : ?>
                            
                            <a type="button" class="btn btn-sm btn-info disabled m-0 me-4" href="<?= base_url() ?>tagihan/detail/<?= $detail->row()->id_santri;?>">Tambahan</a> 
              
                             <?php endif?>
                            
                          </li>

                        </ul>
                       <!--  <form class="form-inline my-2 my-lg-0">
                          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form> -->

                      </div>
                     <!--  <a type="button" href="<?= base_url() ?>tagihan/excel" class="btn btn-sm btn-dark m-0 me-4">
                        export
                    </a> -->
                    </nav>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Keterangan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tagihan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bayar</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tunggakan</th>
                                <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lihat</th> -->
                                <!-- <th colspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = $this->uri->segment('4') + 1;
                            $total_tagihan = 0;
                            $total_bayar = $this->db->select('sum(gross_amount) as total_bayar')->where(['id_santri' => $detail->row()->id_santri, 'status_code' => 200])->get('tb_bayar_tahunan')->row()->total_bayar;
                            $tb = $total_bayar;
                            foreach ($detail->result() as $key) :
                                $total_tagihan += $key->tagihan_tahunan;
                                if ($tb >= $key->tagihan_tahunan) {
                                    $bayar = $key->tagihan_tahunan;
                                } else if ($tb <= 0) {
                                    $bayar = 0;
                                } else {
                                    $bayar = $tb;
                                } ?>
                                <tr class="<?php echo $lunas = ($key->tagihan_tahunan == $bayar) ? 'text-success' : ''; ?>">
                                    <td class="text-center">
                                        <?= $no++ ?>
                                    </td>
                                    <td>
                                        <?= $key->ket ?>
                                    </td>
                                    <td>
                                        <?= "Rp " . number_format($key->tagihan_tahunan, 0, ',', '.'); ?>
                                    </td>
                                    <td>
                                        <?= "Rp " . number_format($bayar, 0, ',', '.'); ?>
                                    </td>
                                    <td>
                                        <?= "Rp " . number_format($key->tagihan_tahunan - $bayar, 0, ',', '.'); ?>
                                    </td>
                                    <!-- <td>
                                        <a href="#"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <a href="#" onclick="hapus('<?= base_url() ?>tagihan/hapus/<?= $key->id_santri ?>', 'Apakah Anda Ingin Menghapus ..?')"><i class="fa fa-trash"></i></a>
                                    </td> -->
                                </tr>

                            <?php $tb -= $key->tagihan_tahunan;
                            endforeach ?>
                        </tbody>
                    </table>
                    <br>
                    <?= $this->pagination->create_links();?>
                </div>
                <div class="row mx-4">
                    <div class="col-md-6">
                        <table class="table ">
                            <tr>
                                <th>Total Tagihan </th>
                                <th> = </th>
                                <th> Rp <?= number_format($total_tagihan, 0, ',', '.') ?></th>
                            </tr>
                            <tr>
                                <th>Total Bayar </th>
                                <th> = </th>
                                <th> Rp <?= number_format($total_bayar, 0, ',', '.')  ?></th>
                            </tr>
                            <tr>
                                <th>Total Tunggakan </th>
                                <th> = </th>
                                <th> Rp <?= number_format($total_tagihan - $total_bayar, 0, ',', '.') ?></th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <form action="<?= base_url() ?>tagihan/bayar_detail_tahunan/<?= $detail->row()->id_santri ?>" method="POST" id="form_bayar">
                            <div class="input-group input-group-outline mb-3">
                                <label for="bayar" class="form-label">Bayar</label>
                                <input type="number" class="form-control" name="bayar" id="bayar">
                            </div>
                            <button type="submit" class="btn btn-sm btn-info">bayar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($pembayar->result()) { ?>
            <div class="card my-4 mt-5">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class=" text-white text-capitalize ps-3">Pembayaran</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Id Pembayaran</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Waktu Transaksi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tipe Transaksi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ket Transaksi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Petunjuk</th>
                                    <th colspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($pembayar->result() as $key) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no++ ?>
                                        </td>
                                        <td> <?= $key->order_id ?></td>
                                        <td><?= "Rp " . number_format($key->gross_amount, 0, ',', '.'); ?></td>
                                        <td> <?= $key->transaction_time ?></td>
                                        <td> <?= $key->payment_type ?></td>
                                        <td> <?= $key->payment_ket ?></td>
                                        <?php if ($key->status_code == 200) { ?>
                                            <td> <span class="badge badge-sm bg-gradient-success">Sukses</span> </td>
                                        <?php } elseif ($key->status_code == 201) { ?>
                                            <td> <span class="badge badge-sm bg-gradient-warning">Tertunda</span> </td>
                                        <?php } elseif ($key->status_code == 202) { ?>
                                            <td> <span class="badge badge-sm bg-gradient-danger">Expired</span> </td>
                                        <?php } else { ?>
                                            <td> <span class="badge badge-sm bg-gradient-danger">Gagal</span> </td>
                                        <?php } ?>
                                        <?php if ($key->status_code == 201 && $key->pdf_url != '') { ?>
                                            <td> <a target="_blank" href="<?= $key->pdf_url ?>" class="badge badge-sm bg-gradient-info"><i class="fa fa-arrow-down"></i></a> </td>
                                        <?php } else {
                                            echo '<td></td>';
                                        } ?>
                                        <td>
                                            <a href="#" onclick="edit('<?= base64_encode($key->order_id) ?>', '<?= $key->id_santri ?>' , '<?= $key->gross_amount ?>')"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <a href="#" onclick="hapus('<?= base_url() ?>tagihan/hapus_bayar_tahunan/<?= $key->id_santri ?>?order_id=<?= base64_encode($key->order_id) ?>', 'Apakah Anda Ingin Menghapus ..?')"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
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
                <form method="POST" id="form_edit_bayar">
                    <div class="input-group input-group-outline mb-3 is-filled">
                        <label for="bayar" class="form-label">Bayar</label>
                        <input type="number" class="form-control" name="bayar" id="editbayar">
                        <input type="hidden" class="form-control" name="order_id" id="order_id">
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
    function edit(order_id, id_santri, total) {
        $('#modal_bayar').modal('show');
        $('#form_edit_bayar').attr('action', '<?= base_url() ?>tagihan/update_bayar_tahunan/' + id_santri);
        $('#editbayar').val(total);
        $('#order_id').val(order_id);
    }
</script>