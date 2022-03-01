<?php

namespace App\Http\Controllers;

use App\Models\Tel;
use Illuminate\Http\Request;

class TelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Tel = Tel::all();
        return response()->json($Tel);
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
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
            ]);
            $Tel = Tel::create($request->all());
            return response()->json([
                'status' => 'success',
                'message'=>'Record Successfully Add',
            ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tel  $tel
     * @return \Illuminate\Http\Response
     */
    public function show(tel $tel)
    {
        //
        return $tel;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tel  $tel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tel $tel)
    {
        //
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);
        $tel->update($request->all());
        return response()->json([
            'status' => 'success',
            'message'=>'Record Successfully Updated',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tel  $tel
     * @return \Illuminate\Http\Response
     */
    public function destroy(tel $tel)
    {
        //
        $tel->delete();
        return response()->json([
            'status' => 'success',
            'message'=>'Record Successfully Deleted',
        ],204);
    }
}
