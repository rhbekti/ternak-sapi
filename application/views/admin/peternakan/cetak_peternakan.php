<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Ternak <?= $rs->id_peternakan; ?></title>
    <style>
        .kepala-surat{
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }
        .no-surat li{
            text-decoration: none;
            list-style: none;
            margin-left: 65%;
        }
        .pengantar{
            text-align: center;
        }
        .isi-surat{
            margin-top: 40px;
            margin-left: 20%;
        }
        .foot-surat{
            margin-left : 15%;

        }
        .foot-surat tr,td{
            height: 25px;
            padding:10px 20px;
        }
    </style>
</head>
<body>
    <div class="kotak">
        <div class="kepala-surat">
            <h2>Surat Pendataan Ternak</h2>
            <p>DINAS PENCATATAN TERNAK KABUPATEN KEBUMEN</p>
            Kompleks Perumahan Bumi Pejagoan Residence
            <hr>
            <br>
        </div>
        <div class="no-surat">
            <ul>
                <li>No Siup : <?=$rs->nosiup;?></li>
            </ul>
        </div>
        <div class="pengantar">
            <p>Berdasarkan hasil pendataan ternak tahun <?=date('Y'); ?>.Dengan ini hasil keterangan sebagai berikut :</p>
        </div>
        <div class="isi-surat">
            <table>
                <tr>
                    <td>Pemilik Peternakan</td>
                    <td>&nbsp;</td>
                    <td>:</td>
                    <td><?=$rs->namapeternak?></td>
                </tr>
                <tr>
                    <td>Nama Peternakan</td>
                    <td>&nbsp;</td>
                    <td>:</td>
                    <td><?=$rs->namapeternakan?></td>
                </tr>
                <tr>
                    <td>Alamat Peternakan</td>
                    <td>&nbsp;</td>
                    <td>:</td>
                    <td><?=$rs->alamat?></td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>&nbsp;</td>
                    <td>:</td>
                    <td><?=$rs->namakecamatan?></td>
                </tr>
                <tr>
                    <td>Kabupaten</td>
                    <td>&nbsp;</td>
                    <td>:</td>
                    <td><?=$rs->namakabupaten?></td>
                </tr>
                <tr>
                    <td>Provinsi</td>
                    <td>&nbsp;</td>
                    <td>:</td>
                    <td><?=$rs->namapropinsi?></td>
                </tr>
            </table>
        </div>
        <div class="foot-surat">
            <br>

            <table>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center">Kepala Dinas</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Untung Subagyo S.Kom,M.Kom</td>
                    <td></td>
                </tr>
                <tr>
                    <td align="center">Sekretaris</td>
                    <td align="center">Dinas Pencatat</td>
                    <td align="center">Dinas Sensus</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Rahma Nur A</td>
                    <td align="center">Asih Subekti</td>
                    <td>Wahyu Tri Lestari</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>