<?php

namespace App\Http\Controllers;

use App\Models\Meninggal;
use Illuminate\Http\Request;
use App\Http\Resources\API;
use Validator;

class MeninggalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil model meninggal
        $data = Meninggal::get();

        //menampilkan nilai data ke json
        return new API(true, 'Data Meninggal', $data);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Insert data
        $input = $request->all();
        $validator = Validator::make($request->all(),[
            'tempat_meninggal'           => 'required|string|max:255',
            'pemakaman_id'          => 'required|integer|max:255',
            'alm_id'                     => 'required|integer|max:255',
            'tanggal_meninggal'          => 'required|date|max:255'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $data = Meninggal::create($input);
        return response()->json([
            "success" => true,
            "message" => "data Meninggal berhasil ditambahkan",
            "data" => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meninggal  $meninggal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //tampil data sesuai id
        $data = Meninggal::find($id);
        if (is_null($data)) {
        return response()->json("Not Found!");
        }
        return new API(true, 'OK!', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meninggal  $meninggal
     * @return \Illuminate\Http\Response
     */
    public function edit(Meninggal $meninggal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meninggal  $meninggal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meninggal $meninggal)
    {
        //ubah data
        $validator = Validator::make($request->all(),[
            'tempat_meninggal' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $meninggal->update([
            'tempat_meninggal' => $request->tempat_meninggal,
        ]);

        return response()->json([
            "success" => true,
            "message" => "data Meninggal berhasil Diubah",
            "data" => $meninggal
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meninggal  $meninggal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meninggal $meninggal)
    {
        //
        $meninggal->delete();

        //return response
        return new API(true, 'Data Berhasil Dihapus!', null);
    }
}
