<?php

namespace App\Http\Controllers;

use App\Models\Blok;
use Illuminate\Http\Request;
use App\Http\Resources\API;
use Validator;

class BlokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //mengambil model meninggal
        $data = Blok::get();

        //menampilkan nilai data ke json
        return new API(true, 'Data Blok', $data);
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
            'nama_blok'      => 'required|string|max:255',
            'nomor'          => 'required|string|max:255',
            'posisi'         => 'required|string|max:255'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $data = Blok::create($input);
        return response()->json([
            "success" => true,
            "message" => "data Blok berhasil ditambahkan",
            "data" => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blok  $blok
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //tampil data sesuai id
        $data = Blok::find($id);
        if (is_null($data)) {
        return response()->json("Not Found!");
        }
        return new API(true, 'OK!', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blok  $blok
     * @return \Illuminate\Http\Response
     */
    public function edit(Blok $blok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blok  $blok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blok $blok)
    {
        //ubah data
        $validator = Validator::make($request->all(),[
            'nama_blok'  => 'required|string|max:255',
            'nomor'      => 'required|string|max:255',
            'posisi'     => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $blok->update([
            'nama_blok' => $request->nama_blok,
            'nomor'     => $request->nomor,
            'posisi'    => $request->posisi,
        ]);

        return response()->json([
            "success" => true,
            "message" => "data Blok berhasil Diubah",
            "data" => $blok
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blok  $blok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blok $blok)
    {
        //
        $blok->delete();

        //return response
        return new API(true, 'Data Berhasil Dihapus!', null);
    }
}
