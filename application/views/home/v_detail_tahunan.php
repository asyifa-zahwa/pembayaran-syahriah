<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-VlPE9sd7PY5vhZkW"></script>
 <!--<script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-F0XRn4lGnYRpqPM-"></script> -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<?php $detail = $data->row() ?>
<div class="container">
    <div class="row" style="margin-top: 80px;">
        <div class="col-12 text-center my-5">
            <h3>Pembayaran SPP Santri<br> <span class="text-success"><?= ucwords($detail->nama) ?></span></h3>
        </div>
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <!-- <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                    <h6 class=" text-white text-capitalize ps-3"><?= $title  ?></h6>
                </div> -->
                <nav class="navbar navbar-expand-lg bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                    
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            
                          <li class="nav-item">
                            <?php 
                            if ( isset($this->db->select('id_santri as id')->where(['id_santri' => $detail->id_santri])->get('tb_tagihan_bulanan')->row()->id) ) : ?>
                            <a type="button" class="btn btn-sm btn-info m-0 me-4" href="<?= base_url() ?>home/detail_bulanan/<?= $detail->id_santri;?>">Bulanan</a>
                            <?php else : ?>
                            
                            <a type="button" class="btn btn-sm btn-info disabled m-0 me-4" href="<?= base_url() ?>home/detail_bulanan/<?= $detail->id_santri;?>">Bulanan</a> 
              
                             <?php endif?>
                          </li>
                          <li class="nav-item">
                          <?php 
                            if ( isset($this->db->select('id_santri as id')->where(['id_santri' => $detail->id_santri])->get('tb_tagihan_tahunan')->row()->id) ) : ?>
                            <a type="button" class="btn btn-sm btn-warning disabled m-0 me-4" href="<?= base_url() ?>home/detail_tahunan/<?= $detail->id_santri;?>">Tahunan</a>
                            <?php else : ?>
                            
                            <a type="button" class="btn btn-sm btn-warning disabled m-0 me-4" href="<?= base_url() ?>home/detail_tahunan/<?= $detail->id_santri;?>">Tahunan</a> 

              
                             <?php endif?>
                          </li>
                          <li class="nav-item">
                            
                            <?php 
                            if ( isset($this->db->select('id_santri as id')->where(['id_santri' => $detail->id_santri])->get('tb_tagihan')->row()->id) ) : ?>
                            <a type="button" class="btn btn-sm btn-info m-0 me-4" href="<?= base_url() ?>home/detail/<?= $detail->id_santri;?>">Tambahan</a>
                            <?php else : ?>
                            
                            <a type="button" class="btn btn-sm btn-info disabled m-0 me-4" href="<?= base_url() ?>home/detail/<?= $detail->id_santri;?>">Tambahan</a> 
              
                             <?php endif?>
                            
                          </li>

                        </ul>
                       <!--  <form class="form-inline my-2 my-lg-0">
                          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form> -->

                      </div>
                    <div>
                        <a type="button" href="<?= base_url() ?>home" class="btn btn-sm btn-dark m-0 me-4">Home</a>
                    </div>
                
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = $this->uri->segment(4)+1;
                                $total_tagihan = 0;
                                $total_bayar = $this->db->select('sum(gross_amount) as total_bayar')->where(['id_santri' => $detail->id_santri, 'status_code' => 200])->get('tb_bayar_tahunan')->row()->total_bayar;
                                $tb = $total_bayar;
                                foreach ($data->result() as $key) :
                                    $total_tagihan += $key->tagihan_tahunan;
                                    if ($tb >= $key->tagihan_tahunan) {
                                        $bayar = $key->tagihan_tahunan;
                                    } else if ($tb <= 0) {
                                        $bayar = 0;
                                    } else {
                                        $bayar = $tb;
                                    } ?>
                                    <tr class="<?php echo $lunas = ($bayar == $key->tagihan_tahunan) ? 'text-success' : ''; ?>">
                                        <td class="text-center">
                                            <?= $no++ ?>
                                        </td>
                                        <td>
                                            <?= ucwords($key->ket) ?>
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
                                    </tr>
                                <?php $tb -= $key->tagihan_tahunan;
                                endforeach ?>
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="row mx-5 px-2">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Total Tagihan </th>
                                    <th> = </th>
                                    <th> Rp <?= number_format($total_tagihan, 0, ',', '.') ?></th>
                                </tr>
                                <tr>
                                    <th>Total Bayar </th>
                                    <th> = </th>
                                    <th> Rp <?= number_format($total_bayar, 0, ',', '.') ?></th>
                                </tr>
                                <tr>
                                    <th>Total Tunggakan </th>
                                    <th> = </th>
                                    <th> Rp <?= number_format($total_tagihan - $total_bayar, 0, ',', '.') ?></th>
                                </tr>
                            </table>
                        </div>
                        <?= $this->pagination->create_links();?>
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
                                                <td> <a target="_blank" href="<?= $key->pdf_url ?>" class="badge badge-sm bg-gradient-info">download</a> </td>
                                            <?php } ?>
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
</div>
<script>
    $('#pay-button').click(function(event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");
        var id_santri = <?= $data->row()->id_santri ?>;
        var nama = '<?= $detail->nama ?>';
        var jumlah = $('#bayar').val();
        $.ajax({
            type: 'post',
            url: '<?= site_url() ?>home/token',
            data: {
                nama: nama,
                jumlah: jumlah,
                id_santri: id_santri,
            },
            cache: false,

            success: function(data) {
                //location = data;

                console.log('token = ' + data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                }

                snap.pay(data, {

                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        location.reload();
                        // changeResult('error', result);
                        // console.log(result.status_message);
                        // $("#payment-form").submit();
                    }
                });
            }
        });
    });

</script>