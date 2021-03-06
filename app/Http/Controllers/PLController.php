<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PLController extends Controller
{
    //
    
    public function index($idpl) {

        $data =  DB::table('TRANS_PACKING_LIST_HEADER')
        ->selectRaw(" 
        TRANS_PACKING_LIST_HEADER.NOMER_PACKING_LIST, TRANS_PACKING_LIST_HEADER.ID AS ID_PL, TRANS_PACKING_LIST_HEADER.CREATE_DATE, 
        TRANS_PACKING_LIST_HEADER.LAST_UPDATE, TRANS_PACKING_LIST_HEADER.ON_CLOSE, TRANS_PACKING_LIST_HEADER.ON_CLOSE_DATE, 
        TRANS_PACKING_LIST_HEADER.TAHUN, TRANS_PACKING_LIST_HEADER.BULAN, MS_JENIS_PEMBAYARAN.JENIS_PEMBAYARAN, 
        TRANS_PACKING_LIST_HEADER.NOMER_BL, MS_JENIS_PENGIRIMAN.NAME AS JENIS_PENGIRIMAN, 
        MS_CUSTOMER.NAMA_CUSTOMER, MS_CUSTOMER.KODE AS KODE_CUSTOMER, MS_CUSTOMER.ATTRIBUTE1 AS BA_NONBA, 
        TRANS_PACKING_LIST_HEADER.ATTRIBUTE1 AS MERK, MS_CUSTOMER_DISTRIBUSI.DATA_LENGKAP AS ALAMAT_TUJUAN_KIRIM, 
        KOTA1.KOTA AS KOTA_ASAL, KOTA2.KOTA AS KOTA_TUJUAN, MS_SYSTEM_LOKASI.LOKASI, MS_GUDANG.NAMA AS GUDANG, MS_PELAYARAN.NAMA_PELAYARAN, 
        MS_JADWAL_KAPAL.ID AS ID_PELAYARAN, MS_JADWAL_KAPAL.NAMA_KAPAL, MS_JADWAL_KAPAL.FOI, MS_JADWAL_KAPAL.TGL_KEBERANGKATAN, MS_JADWAL_KAPAL.TGL_TIBA,
        MS_JENIS_MUATAN.NAMA AS JENIS_MUATAN, MS_JENIS_PACKING.PACKING AS JENIS_PACKING, 
        TRANS_PACKING_LIST_HEADER.TGL_INVOICE, TRANS_PACKING_LIST_HEADER.TGL_INVOICE_JATUH_TEMPO, TRANS_PACKING_LIST_HEADER.TGL_INVOICE_DIKIRIM,
        TRANS_PACKING_LIST_HEADER.TGL_INVOICE_SAMPAI_TUJUAN, TRANS_PACKING_LIST_HEADER.TGL_INVOICE_KEMBALI, 
        TRANS_PACKING_LIST_HEADER.TGL_KIRIM_NOTA, TRANS_PACKING_LIST_HEADER.SURAT_JALAN_DIKIRIM,
        TRANS_PACKING_LIST_HEADER.TOTAL_BIAYA, TRANS_PACKING_LIST_HEADER.TERBILANG, TRANS_PACKING_LIST_HEADER.NO_DO_TRUCKING_ORIGIN,
        TRANS_PACKING_LIST_HEADER.NO_DO_TRUCKING_DESTINANTION
        ")
        ->join('MS_JENIS_PENGIRIMAN', 'MS_JENIS_PENGIRIMAN.ID', '=', 'TRANS_PACKING_LIST_HEADER.ID_JENIS_PENGIRIMAN')
        ->join('MS_JENIS_PEMBAYARAN', 'MS_JENIS_PEMBAYARAN.ID', '=', 'TRANS_PACKING_LIST_HEADER.ID_JENIS_PEMBAYARAN')
        ->join('MS_CUSTOMER', 'MS_CUSTOMER.ID', '=', 'TRANS_PACKING_LIST_HEADER.ID_CUSTOMER' )
        ->join('MS_CUSTOMER_DISTRIBUSI', 'MS_CUSTOMER_DISTRIBUSI.ID', '=', 'TRANS_PACKING_LIST_HEADER.ID_CUSTOMER_DISTRIBUSI')
        ->join('MS_KOTA AS KOTA1', 'KOTA1.ID', '=', 'TRANS_PACKING_LIST_HEADER.ID_KOTA_ASAL')
        ->join('MS_KOTA AS KOTA2', 'KOTA2.ID', '=', 'TRANS_PACKING_LIST_HEADER.ID_KOTA_TUJUAN')
        ->join('MS_SYSTEM_LOKASI', 'MS_SYSTEM_LOKASI.ID', '=', 'TRANS_PACKING_LIST_HEADER.ID_LOKASI')
        ->join('MS_GUDANG', 'MS_GUDANG.ID', '=', 'TRANS_PACKING_LIST_HEADER.ID_GUDANG')
        ->join('MS_PELAYARAN', 'MS_PELAYARAN.ID', '=', 'TRANS_PACKING_LIST_HEADER.ID_PELAYARAN')
        ->join('MS_JADWAL_KAPAL', 'MS_JADWAL_KAPAL.ID', '=', 'TRANS_PACKING_LIST_HEADER.ID_JADWAL_PELAYARAN')
        ->join('MS_JENIS_MUATAN', 'MS_JENIS_MUATAN.ID', '=', 'TRANS_PACKING_LIST_HEADER.ID_JENIS_MUATAN')
        ->join('MS_JENIS_PACKING', 'MS_JENIS_PACKING.ID', '=', 'TRANS_PACKING_LIST_HEADER.ID_JENIS_PACKING')
        // ->leftjoin('TRANS_PACKING_LIST_DETAIL', 'TRANS_PACKING_LIST_DETAIL.ID_PACKING_HEADER', '=', 'TRANS_PACKING_LIST_HEADER.ID')
        // ->where('TRANS_PACKING_LIST_HEADER.TAHUN', 2019)
        // ->where('TRANS_PACKING_LIST_HEADER.NOMER_PACKING_LIST', 'PL/01.2019.09/021669')
        ->where('TRANS_PACKING_LIST_HEADER.ID', $idpl)
        ->distinct()
        ->get();
        
        return response()->json($data);
      }

}
