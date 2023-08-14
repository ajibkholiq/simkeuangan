<?php

namespace App\Http\Controllers;

use App\Models\AkunHead;
use Illuminate\Http\Request;
use App\Helper\menu;
use Session;


class AkunHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = menu::getMenu(Session::get('role'));
        return view('page.MasterData.akun_head',compact(['menu']));
      
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
        $data = AkunHead::create([
            'uuid' => uniqid(),
            'akun_head' => $request ->akun_head,
            'urut' => $request -> urut,
            'remark' => $request->remark,
            'created_by' => Session::get('nama')

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
    public function show($id)
    {
        return response()->json(AkunHead::where('uuid',$id)->first(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AkunHead $akunHead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $data = AkunHead::where('uuid',$id)->update([
            'akun_head' => $request->akun_head,
            'urut' => $request->urut,
            'remark' => $request->remark,
            'created_by' => Session::get('nama')
          ]);

          if(!$data){
             return response()->json([
                "mesage" => "Gagal diubah",
                ]
            );
        }
        return response()->json(['succsess' => 'data akun berhasil ubah', 'data' => $request]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
        {
            if(AkunHead::where('uuid',$id)->delete()){
                return response()->json(['succsess' => 'data berhasil dihapus', 'data' => $id]);
            }
            return response()->json(['fail' => 'akun gagal dihapus', 'data' => $id]);
        }
    
}
