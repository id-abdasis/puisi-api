<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Puisi;
use Validator;
class PuisiController extends Controller
{
    public function index()
    {
        return "Hai ini adalah halaman index";
    }

    public function tambahPuisi(Request $request)
    {
        $puisi =  Puisi::create([
            'judul_puisi' => $request->judul_puisi,
            'isi_puisi' => $request->isi_puisi,
            'slug' => Str::slug($request->judul_puisi)
        ]);

        return response([
            'status' => 200,
            'result' => 'Berhasil Menambah Data'
        ]);

        
    }

    public function dataPuisi()
    {
        $puisies =  Puisi::all();
        if ($puisies->count() > 0) {
            return response()->json($puisies, 200);     
        }else{
            return response()->json(['status' => 404, 'message' => 'Masih belum ada data'], 404);
        }
    }

    public function ubahPuisi($id)
    {
        $puisi = Puisi::find($id);
        return response()->json($puisi, 200);
    }

    public function updatePuisi(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'judul_puisi' => 'required',
            'isi_puisi' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Terjadi masalah saat udpate data',
                'errors' => $validator->errors(),
            ], 200);
        }

        $puisi = Puisi::find($request->id);
        $updatePuisi = $puisi->update([
            'judul_puisi' =>  $request->judul_puisi,
            'slug' => Str::slug($request->judul_puisi),
            'isi_puisi' => $request->isi_puisi
        ]);

        if ($updatePuisi) {
            return response()->json(['message' => 'Data Berhasil Diupdate'], 200);
        }else{
            return response()->json(['message' => 'Data Gagal Diupdate'], 200);
        }

    }

    public function deletePuisi($id)
    {
        $puisi = Puisi::find($id);
        if ($puisi->count() > 0) {
            $puisi->delete();
            return response()->json([
                'message' => 'Data Berhasil Dihapus',
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada data yang di temukan'
            ]);
        }
    }
}