<div class="container">
    <div class="row" style="margin-top: 80px;">
        <div class="col-12 text-center my-5">
            <h3>Transaksi Berhasil</h3>
        </div>
        <div class="col-lg-3">

        </div>
        <div class="col-lg-6">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class=" text-white text-capitalize ps-3"><?= $detail->nama ?> (<?= $detail->alamat ?>)</h6>
                    </div>
                </div>
                <div class="card-body px-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Kode Santri </td>
                                <td> : </td>
                                <td> <?= $detail->kode ?> </td>
                            </tr>
                            <tr>
                                <td>Nama Santri </td>
                                <td> : </td>
                                <td> <?= $detail->nama ?> </td>
                            </tr>
                            <tr>
                                <td>Alamat Santri </td>
                                <td> : </td>
                                <td> <?= $detail->alamat ?> </td>
                            </tr>
                            <tr>
                                <td>Id Pembayaran </td>
                                <td> : </td>
                                <td> <?= $detail->order_id ?> </td>
                            </tr>
                            <tr>
                                <td>Total </td>
                                <td> : </td>
                                <td> <?= "Rp." . number_format($detail->gross_amount); ?> </td>
                            </tr>
                            <tr>
                                <td>Waktu Transaksi </td>
                                <td> : </td>
                                <td> <?= $detail->transaction_time ?> </td>
                            </tr>
                            <tr>
                                <td>Type Pembayaran </td>
                                <td> : </td>
                                <td> <?= $detail->payment_type ?> </td>
                            </tr>
                            <tr>
                                <td>Ket Pembayaran </td>
                                <td> : </td>
                                <td> <?= $detail->payment_ket ?> </td>
                            </tr>
                            <tr>
                                <td>Status Pembayaran </td>
                                <td> : </td>
                                <?php if ($detail->status_code == 200) { ?>
                                    <td> <span class="badge badge-sm bg-gradient-success">Sukses</span> </td>
                                <?php } elseif ($detail->status_code == 201) { ?>
                                    <td> <span class="badge badge-sm bg-gradient-warning">Tertunda</span> </td>
                                <?php } ?>
                            </tr>
                        </thead>
                    </table>
                    <div class="text-center">
                        <?php if ($detail->status_code == 201 && $detail->pdf_url != '') { ?>
                            <a target="_blank" href="<?= $detail->pdf_url ?>" class="btn btn-sm btn-info">Pentunjuk Pembayaran</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>