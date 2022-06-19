<?php

namespace App\Http\Controllers;

use App\Models\Heregistrasi;
use Illuminate\Http\Request;
use App\Http\Resources\API;
use Validator;

class HeregistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //mengambil model heregistrasi
        $data = Heregistrasi::get();

        //menampilkan nilai data ke json
        return new API(true, 'Data Heregistrasi', $data);
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
        //
        //Insert data
        $input = $request->all();
        $validator = Validator::make($request->all(),[
            'alm_id'                => 'required|integer|max:255',
            'registrasi_id'         => 'required|integer|max:255',
            'nominal'               => 'required',
            'tanggal_heregistrasi'  => 'required|date|max:255'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $data = Heregistrasi::create($input);
        return response()->json([
            "success" => true,
            "message" => "data Heregistrasi berhasil ditambahkan",
            "data" => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Heregistrasi  $heregistrasi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //tampil data sesuai id
        $data = Heregistrasi::find($id);
        if (is_null($data)) {
        return response()->json("Not Found!");
        }
        return new API(true, 'OK!', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Heregistrasi  $heregistrasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Heregistrasi $heregistrasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Heregistrasi  $heregistrasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Heregistrasi $heregistrasi)
    {
        //
        //ubah data
        $validator = Validator::make($request->all(),[
            'alm_id'                => 'required|integer|max:255',
            'registrasi_id'         => 'required|integer|max:255',
            'nominal'               => 'required',
            'tanggal_heregistrasi'  => 'required|date|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $heregistrasi->update([
            'alm_id'                => $request->alm_id,
            'registrasi_id'         => $request->registrasi_id,
            'nominal'               => $request->nominal,
            'tanggal_heregistrasi'  => $request->tanggal_heregistrasi
        ]);

        return response()->json([
            "success" => true,
            "message" => "data Heregistrasi berhasil Diubah",
            "data" => $heregistrasi
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Heregistrasi  $heregistrasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Heregistrasi $heregistrasi)
    {
        //
        $heregistrasi->delete();

        //return response
        return new API(true, 'Data Berhasil Dihapus!', null);
    }
}
