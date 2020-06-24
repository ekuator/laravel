<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Penyewaan;
use Validator;

class PenyewaanController extends Controller
{
	public $successStatus = 200;
		
    public function index()
    {
		$success['data'] = Penyewaan::all();
		$success['code'] = $this->successStatus; 
    	return response()->json(['success' => $success], $this->successStatus);
    }

    public function create(Request $request)
    {
    	$validator = Validator::make($request->all(), [ 
			'id_buku'     => 'required', 
			'tgl_sewa'    => 'required', 
			'tgl_kembali' => 'required', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
		}

		$sewa    = date_create($request->tgl_sewa);
		$kembali = date_create($request->tgl_kembali);
		$biaya   = 1000;

		$input                 = $request->all(); 
		$input['jml_hari']     = date_diff($sewa, $kembali);
		$input['total_biaya']  = ($input['jml_hari'] * $biaya);
		$buku                  = Penyewaan::create($input);
		$success['code']       = $this->successStatus; 
		$success['status']     = "Penyewaan berhasi dibuat"; 
		return response()->json(['success' => $success], $this->successStatus);
    }
}
