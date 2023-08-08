<?php

namespace App\Http\Controllers;

use App\Models\AkunHead;
use App\Models\AkunHeadSub;
use Illuminate\Http\Request;
use App\Helper\menu;
use Session;

class AkunHeadSubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = menu::getMenu(Session::get('role'));
        $akun_head = AkunHead::all();
        return view('page.MasterData.akun_head_sub',compact(['menu','akun_head']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $data = AkunHeadSub::create([
            'uuid' => uniqid(),
            'akun_head_sub'=> $request->akun_head_sub,
            'akun_head_id' => $request->akun_head_id,
            'urut' => $request ->urut,
            'remark' => $request ->remark,
            'created_by' => session::get('nama')
        ]);
        if (!$data){
            return response()->json([
               "mesage" => "Gagal ditambahkan",
               'data' => $data
               ]
           );
       }
       return redirect()->back()->with('success','Akun Head Behasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(AkunHeadSub $akunHeadSub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AkunHeadSub $akunHeadSub)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AkunHeadSub $akunHeadSub)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AkunHeadSub $akunHeadSub)
    {
        //
    }
}
