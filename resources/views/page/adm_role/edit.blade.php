@extends('layout.master')
@section('main')
<div class="ibox float-e-margins">
    <div class="ibox-content">
        <h2>Edit Role</h2>

        <form action="{{ route('adm_role.update', $adm_role->id) }}, $adm_role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="uuid">UUID:</label>
                <input type="text" name="uuid" class="form-control" value="{{ $adm_role->uuid }}">
            </div>
            <div class="form-group">
                <label for="nama_role">Nama Role:</label>
                <input type="text" name="nama_role" class="form-control" value="{{ $adm_role->nama_Role }}">
            </div>
            <div class="form-group">
                <label for="remark">Remark:</label>
                <input type="text" name="remark" class="form-control" value="{{ $adm_role->remark }}">
            </div>
         
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@endsection 