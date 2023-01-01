<?php
header("Content-Type:application/vnd.ms-excel");
header('Content-Disposition:attachment; filename="Data Pembayaran Biaya Bulanan.xls"');
?>
<h2>Data Pembayaran Biaya Bulanan</h2>
<table border="1">
    <tr>
        <th>NO</td>
        <th>Nama</td>
            <?php foreach ($spp->result() as $s) : ?>
        <th><?= $s->ket ?> (<?= "Rp " . number_format($s->jumlah, 0, ',', '.'); ?>)</td>
        <?php endforeach ?>
        <!-- <th>Jumlah tagihan</td>
        <th>jumlah bayar</td> -->
        <th>Keterangan</td>
    </tr>

    <?php $no = 1;
    foreach ($detail->result() as $t) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <?
            $nama_santri = $this->db->select('nama as nama_santri')->where(['id_santri' => $t->id_santri])->get('tb_santri')->row()->nama_santri;
            ?>
            <td><?= $nama_santri ?></td>
            <?php
            $jumlah_tagihan = 0;
            $jumlah_bayar = $this->db->select('sum(gross_amount) as bayar')->where(['id_santri' => $t->id_santri])->get('tb_bayar_bulanan')->row()->bayar;
            $jb = $jumlah_bayar;
            foreach ($spp->result() as $s) :
                $as = $this->db->select('tagihan_bulanan')->where(['id_spp_bulanan' => $s->id_spp_bulanan, 'id_santri' => $t->id_santri])->get('tb_tagihan_bulanan');
                if ($as->num_rows() > 0) {
                    $jumlah_tagihan += $as->row()->tagihan_bulanan;
                    
                    $js = $as->row()->tagihan_bulanan;
                    if ($jb >= $js) {
                        echo '<td>' . $as->row()->tagihan_bulanan . '</td>';
                        $jb -= $js;
                    } elseif ($jb <= 0) {
                        echo '<td>' . 0 . '</td>';
                    } else {
                        echo '<td>' . $jb . '</td>';
                        $jb -= $jb;
                    }
                    // echo '<td>' . $as->row()->tagihan . '</td>';
                } else {
                    echo '<td>-</td>';
                }
            endforeach ?>
            <!-- <td><?= $jumlah_tagihan ?></td>
            <td><?= $jumlah_bayar ?></td> -->
            <td><?php $sisa = $jumlah_tagihan - $jumlah_bayar;
            $lebih =  $jumlah_bayar - $jumlah_tagihan;
            if ($sisa >= 0) {
                echo 'Kekurangan ' . $sisa;
            } elseif ($sisa = 0) {
                echo 'LUNAS';
            }else {
                echo 'Kelebihan ' . $lebih;
            }?></td>
        </tr>
    <?php endforeach ?>

</table>
