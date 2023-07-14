<?php

namespace App\Http\Controllers;

use App\Models\adm_role;
use Illuminate\Http\Request;

class Adm_RoleController extends Controller
{
    public function index()
    {
        $adm_roles = adm_role::all();
        return view('page.adm_role.index', compact('adm_roles'));
    }

    public function create()
    {
        return view('page.adm_role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'uuid' => 'required|unique:adm_role|max:20',
            'nama_role' => 'required',
            'remark' => 'required|max:20',
            'create_by' => 'required|max:20',
            'update_by' => 'required|max:20', 
        ]);

        $data = [
            'uuid' => $request->uuid,
            'nama_role' => $request->nama_role,
            'remark' => $request->remark,
            'create_by' => $request->create_by,
            'update_by' => $request->update_by
        ];
        
        adm_role::create($data);

        return redirect()->route('adm_role.index')->with('success', 'Role created successfully');
    }

    public function edit($id) 
    {
        $adm_role = adm_role::findOrFail($id);
        return view('page.adm_role.edit', compact('adm_role'));
    }

    public function update(Request $request, adm_role $adm_role) 
    {
        $validatedData = $request->validate([
            'uuid' => 'required|unique:adm_role,uuid,' . $adm_role->id . '|max:100',
            'nama_role' => 'required',
            'remark' => 'required|max:20',
            'create_by' => 'required|max:20',
            'update_by' => 'required|max:20',
        ]);

        $data = [
            'uuid' => $request->uuid,
            'nama_role' => $request->nama_role,
            'remark' => $request->remark,
            'create_by' => $request->create_by,
            'update_by' => $request->update_by
        ];

        $adm_role->update($data);

        return redirect()->route('adm_role.index')->with('success', 'Role updated successfully');
    }

    public function destroy(adm_role $adm_role) 
    {
        $adm_role->delete();

        return redirect()->route('adm_role.index')->with('success', 'Role deleted successfully');
    }
}