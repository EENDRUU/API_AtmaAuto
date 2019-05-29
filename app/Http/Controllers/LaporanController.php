<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function pengeluaranBulanan($tahun) {
        $data = DB::select(
            'SELECT
                MONTH(TANGGALPEMESANAN) "bulan",
                SUM(TOTALBIAYAPEMESANAN) "pengeluaran"
            FROM
                transaksi_pemesanan_sparepart
            WHERE
             YEAR(TANGGALPEMESANAN) = :tahun
            GROUP BY
                MONTH(TANGGALPEMESANAN)', ['tahun' => $tahun]);

        return response()->json($data, 200);
    }
    public function penjualanJasa($bulan, $tahun) {
        $data = DB::select(
            'SELECT
                NAMAMEREK,
                NAMATIPE,
                NAMAJASA,
                SUM(JUMLAHJASA) "total"
            FROM
                detail_transaksi_penjualanjasa
            JOIN kendaraankonsumen k USING(NOMORPOLISI)
            JOIN merekkendaraan m ON(k.IDMEREK=m.IDMEREK)
            JOIN tipekendaraan t ON (k.IDTIPE=t.IDTIPE)
            JOIN jasa USING(ID_JASA)
            join transaksi_penjualan USING(NOMOR_TRANSAKSI)
            where month(TANGGALPENJUALAN)= :bulan and year(TANGGALPENJUALAN) = :tahun
            and STATUS_BAYAR = "Sudah Dibayar"
            GROUP BY
                NAMAMEREK,
                NAMATIPE,
                NAMAJASA', ['bulan' => $bulan, 'tahun' => $tahun]);

        return response()->json($data, 200);
    }

    public function pendapatanBulanan($tahun) {
        $data = DB::select(
            'SELECT
            bulan,
            tahun,
            SUM(service) "service",
            SUM(sparepart) "sparepart",
            SUM(service) + SUM(sparepart) "total"
            FROM
                (
                SELECT
                    MONTH(TANGGALPENJUALAN) "bulan",
                    YEAR(TANGGALPENJUALAN) "tahun",
                    SUBTOTALJASA "service",
                    0 "sparepart"
                FROM
                    transaksi_penjualan
                JOIN detail_transaksi_penjualanjasa USING(NOMOR_TRANSAKSI)
                WHERE
                    STATUS_BAYAR = "Sudah Dibayar"
                UNION ALL
                SELECT
                    MONTH(TANGGALPENJUALAN) "bulan",
                    YEAR(TANGGALPENJUALAN) "tahun",
                    0 "service",
                    SUBTOTALSPAREPART "sparepart"
                FROM
                    transaksi_penjualan
                JOIN detail_transaksi_penjualanspar USING(NOMOR_TRANSAKSI)
                WHERE
                    STATUS_BAYAR = "Sudah Dibayar"
            ) a
            GROUP BY
                bulan,
                tahun
            HAVING
                tahun = :tahun', ['tahun' => $tahun]);

        return response()->json($data, 200);
    }

    public function sparepartTerlaris($tahun) {
        $data =DB::select(
            'SELECT
            bulan,
            nama,
            tipe,
            MAX(total) "total"
            FROM
                (
                SELECT
                    MONTH(TANGGALPENJUALAN) AS bulan,
                    NAMASPAREPART AS nama,
                    TIPE as tipe,
                    SUM(JUMLAH) AS total
                FROM
                    detail_transaksi_penjualanspar
                JOIN transaksi_penjualan USING(NOMOR_TRANSAKSI)
                join sparepart using(KODE_SPAREPART)
                WHERE
                    YEAR(TANGGALPENJUALAN) = :tahun AND  STATUS_BAYAR = "Sudah Dibayar"
                GROUP BY
                    KODE_SPAREPART,
                    NAMASPAREPART,
                    TIPE,
                    bulan
                ORDER BY
                    total
                DESC
            ) q
            GROUP BY
                bulan
            ORDER BY
                bulan ASC',
                ['tahun' => $tahun]);

        return response()->json($data, 200);
    }

    public function sisaStok($barang, $tahun) {
        $data = DB::select(
            'SELECT
            MONTH(tanggal_histori) "bulan",
            kode_sparepart,
            tipe "tipe_sparepart",
            sisa_stok
            FROM
                historis
            JOIN spareparts USING(kode_sparepart)
            WHERE
                tipe = :barang AND tanggal_histori IN(
                SELECT
                    MAX(tanggal_histori)
                FROM
                    historis
                JOIN spareparts USING(kode_sparepart)
                WHERE
                    YEAR(tanggal_histori) = :tahun AND tipe = :barang1
                GROUP BY
                    MONTH(tanggal_histori),
                    YEAR(tanggal_histori)
                )',
            ['barang' => $barang, 'tahun' => $tahun, 'barang1' => $barang]);

        return response()->json($data, 200);
    }

    public function pendapatanTahunan() {
        // $data = DB::select(
        //     'SELECT
        //     YEAR(tanggal) "tahun",
        //     nama "cabang",
        //     SUM(total_transaksi) "total"
        //     FROM
        //         melayani
        //     JOIN pegawais USING(id_pegawai)
        //     JOIN penjualans USING(no_transaksi)
        //     JOIN cabangs USING(id_cabang)
        //     WHERE
        //         jabatan_pegawai = "Kasir" and keterangan_transaksi = "Lunas"
        //     GROUP BY
        //         nama_cabang,
        //         YEAR(tanggal_transaksi)
        //     ORDER BY tahun, cabang ASC', [1]);

        //     return response()->json($data, 200);

        $data = DB::select(
            'SELECT
            YEAR(TANGGALPENJUALAN) "tahun",
            SUM(TOTALTRANSAKSIPENJUALAN) "total"
            FROM
                transaksi_penjualan
            JOIN pegawai USING(ID_PEGAWAI)
            WHERE
                STATUS_BAYAR = "Sudah Dibayar"
            GROUP BY
                YEAR(TANGGALPENJUALAN)
            ORDER BY tahun', [1]);

            return response()->json($data, 200);
    }
}
