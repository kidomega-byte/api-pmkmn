<?php

namespace App\Http\Controllers;

use App\Models\Pemakaman;
use Illuminate\Http\Request;
use App\Http\Resources\API;
use Validator;

class PemakamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil model pemakaman
        $data = Pemakaman::get();

        //menampilkan nilai data ke json
        return new API(true, 'Data Pemakaman', $data);
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
            'nama_pkm'   => 'required|string|max:255',
            'alamat'     => 'required|string|max:255',
            'blok_id'    => 'required|integer|max:255',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $data = Pemakaman::create($input);
        return response()->json([
            "success" => true,
            "message" => "data Pemakaman berhasil ditambahkan",
            "data" => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemakaman  $pemakaman
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //tampil data sesuai id
        $data = Pemakaman::find($id);
        if (is_null($data)) {
        return response()->json("Not Found!");
        }
        return new API(true, 'OK!', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemakaman  $pemakaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemakaman $pemakaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemakaman  $pemakaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemakaman $pemakaman)
    {
        //ubah data
        $validator = Validator::make($request->all(),[
            'nama_pkm' => 'required|string|max:255',
            'alamat'   => 'required|string|max:255',
            'blok_id'  => 'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pemakaman->update([
            'nama_pkm' => $request->nama_pkm,
            'alamat' => $request->alamat,
            'blok_id' => $request->blok_id,
        ]);

        return response()->json([
            "success" => true,
            "message" => "data Pemakaman berhasil Diubah",
            "data" => $pemakaman
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemakaman  $pemakaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemakaman $pemakaman)
    {
        //
        $pemakaman->delete();

        //return response
        return new API(true, 'Data Berhasil Dihapus!', null);
    }
}
