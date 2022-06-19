<?php

namespace App\Http\Controllers;

use App\Models\Alm;
use Illuminate\Http\Request;
use App\Http\Resources\AhliwarisResource;
use App\Http\Resources\API;
use Validator;



class AlmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Alm::get();
        return new API(true, "Data Orang Meninggal" ,$data);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(),[
            'nik'               => 'required|string|max:255',
            'nama'              => 'required|string|max:255',
            'alamat'            => 'required|string|max:255',
            'gender'            => 'required|string|max:255',
            'tempat_lahir'      => 'required|string',
            'tanggal_lahir'     => 'required|date',
            'meninggal_id'      => 'required|integer|max:255',
            'agama'             => 'required|string|max:255',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $data = Alm::create($input);
        return response()->json([
            "success" => true,
            "message" => "data berhasil ditambahkan",
            "data" => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alm  $alm
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Alm::find($id);
        if (is_null($data)) {
        return response()->json("Not Found!");
        }
        return new API(true, 'OK!', $data);    
 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alm  $alm
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Alm $datameninggal)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alm  $alm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alm $datameninggal)
    {
        $validator = Validator::make($request->all(),[
            'nik' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $datameninggal->update([
            'nik' => $request->nik,
        ]);

        return response()->json([
            "success" => true,
            "message" => "data berhasil Diubah",
            "data" => $datameninggal
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alm  $alm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alm $datameninggal)
    {
        $datameninggal->delete();
        //return response
        return new API(true, 'Data Berhasil Dihapus!', null);
    }
}
