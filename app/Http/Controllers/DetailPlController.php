<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PL_Header;
use DB;

class DetailPlController extends Controller
{
    //
    public function index($idpl) {

        $data = PL_HEADER::select(DB::raw ('tab1.ID_PL, tab1.NOMER_PACKING_LIST, tab1.GROUP_PACKING 
                , tab1.SJM_NOMER, tab1.ID_DETAIL_DATA_BARANG, tab1.ITEM, tab1.PANJANG, tab1.LEBAR, tab1.TINGGI, 
                tab1.VOLUME, tab1.BERAT, tab1.VOLUME_PERSATUAN, tab1.BERAT_PERSATUAN, tab1.QTY_KIRIM, tab1.SATUAN '))
            ->from(DB::raw('
            ( SELECT TRANS_PACKING_LIST_HEADER.NOMER_PACKING_LIST,
                TRANS_PACKING_LIST_HEADER.ID AS ID_PL,
                TRANS_PACKING_LIST_DETAIL.GROUP_PACKING, 
                TRANS_PACKING_LIST_DETAIL.SJM_NOMER,
                TRANS_PACKING_LIST_DETAIL.ID_DETAIL_DATA_BARANG, 
                TRANS_PACKING_LIST_DETAIL.ITEM,
                TRANS_PACKING_LIST_DETAIL.PANJANG, 
                TRANS_PACKING_LIST_DETAIL.LEBAR,
                TRANS_PACKING_LIST_DETAIL.TINGGI,
                TRANS_PACKING_LIST_DETAIL.VOLUME, 
                TRANS_PACKING_LIST_DETAIL.BERAT,
                TRANS_PACKING_LIST_DETAIL.VOLUME_PERSATUAN,
                TRANS_PACKING_LIST_DETAIL.BERAT_PERSATUAN,
                TRANS_PACKING_LIST_DETAIL.QTY_KIRIM,
                MS_SATUAN.SATUAN
                FROM TRANS_PACKING_LIST_HEADER 
                LEFT JOIN TRANS_PACKING_LIST_dETAIL 
                    ON TRANS_PACKING_LIST_HEADER.ID = TRANS_PACKING_LIST_dETAIL.ID_PACKING_HEADER
                LEFT JOIN MS_SATUAN
                    ON TRANS_PACKING_LIST_DETAIL.ID_SATUAN = MS_SATUAN.ID
                WHERE TRANS_PACKING_LIST_HEADER.TAHUN IN (2019)
            
            ) as tab1
            
            '))
            ->where('tab1.ID_PL', '=', $idpl)
            // ->where('tab1.GROUP_PACKING', '=', $GROUP_PACKING)
            ->groupBy('tab1.ID_PL', 'tab1.NOMER_PACKING_LIST', 'tab1.GROUP_PACKING' 
            , 'tab1.SJM_NOMER', 'tab1.ID_DETAIL_DATA_BARANG', 'tab1.ITEM', 'tab1.PANJANG', 'tab1.LEBAR', 'tab1.TINGGI', 
            'tab1.VOLUME', 'tab1.BERAT', 'tab1.VOLUME_PERSATUAN', 'tab1.BERAT_PERSATUAN', 'tab1.QTY_KIRIM', 'tab1.SATUAN' )
            ->get();

            // $keong = $data->groupBy('GROUP_PACKING');
        
        return view('detailpl', [
            'data'    => $data,
        ]);
      }
}
