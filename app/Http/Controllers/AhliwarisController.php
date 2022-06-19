<?php

namespace App\Http\Controllers;

use App\Models\Ahliwaris;
use Illuminate\Http\Request;
use App\Http\Resources\API;
use Validator;

class AhliwarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Ahliwaris::with('alm')->get();
        return new API(true, 'Data Ahli Waris', $data);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(),[
            'nik'           => 'required|string|max:255',
            'nama'          => 'required|string|max:255',
            'alamat'        => 'required|string|max:255',
            'gender'        => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'hubungan'      => 'required|string|max:255',
            'alm_id'        => 'required|integer|max:255',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $data = Ahliwaris::create($input);
        return response()->json([
            "success" => true,
            "message" => "data Ahli Waris berhasil ditambahkan",
            "data" => $data
        ]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ahliwaris  $ahliwaris
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Ahliwaris::find($id);
        if (is_null($data)) {
        return response()->json("Not Found!");
        }
        return new API(true, 'OK!', $data);    
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ahliwaris  $ahliwaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ahliwaris $ahliwari)
    {
        $validator = Validator::make($request->all(),[
            'nik' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $ahliwari->update([
            'nik' => $request->nik,
        ]);

        return response()->json([
            "success" => true,
            "message" => "data Ahli Waris berhasil Diubah",
            "data" => $ahliwari
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ahliwaris  $ahliwaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ahliwaris $ahliwari)
    {
        $ahliwari->delete();

        //return response
        return new API(true, 'Data Berhasil Dihapus!', null);

    }
}
