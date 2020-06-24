<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Buku;
use Validator;

class BukuController extends Controller
{
	public $successStatus = 200;

    public function index()
    {
		$success['data'] = Buku::all();
		$success['code'] = $this->successStatus; 
    	return response()->json(['success' => $success], $this->successStatus);
    }

    public function create(Request $request)
    {
    	$validator = Validator::make($request->all(), [ 
			'judul'     => 'required', 
			'pengarang' => 'required', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
		}


		$input                 = $request->all(); 
		$buku                  = Buku::create($input);
		$success['code']       = $this->successStatus; 
		$success['status']     = "Data berhasil diinput"; 
		$success['judul_buku'] =  $buku->judul; 
		$success['pengarang']  =  $buku->pengarang;
		return response()->json(['success' => $success], $this->successStatus);
    }

    public function update(Request $request, $id)
    {
		$buku            = Buku::find($id);
		$buku->judul     = $request->judul;
		$buku->pengarang = $request->pengarang;
		$buku->save();
		
		$success['code']       = $this->successStatus; 
		$success['status']     = "Data berhasil diubah"; 
		$success['judul_buku'] =  $buku->judul; 
		$success['pengarang']  =  $buku->pengarang;
		return response()->json(['success' => $success], $this->successStatus);
    }

    public function delete($id)
    {
    	$buku = Buku::find($id);
    	$buku->delete();
    	$success['code']       = $this->successStatus; 
		$success['status']     = "Data berhasil dihapus"; 
		$success['judul_buku'] =  $buku->judul; 
		$success['pengarang']  =  $buku->pengarang;
		return response()->json(['success' => $success], $this->successStatus);
    }
}
