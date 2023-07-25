@extends('layout.master')
@section('main')
<div class="ibox float-e-margins" style="margin: 20px 0">
    <div class="ibox-content">
        
        @if ($adm_role)
        <form action="{{ route('adm-role.update', $adm_role->uuid) }}" method="POST">
            @csrf
            @method('PUT')
           
            <div class="form-group">
                <label for="nama_role">Nama Role:</label>
                <input type="text" name="nama_role" required class="form-control" value="{{ $adm_role->nama_role }}">
            </div>
            <div class="form-group">
                <label for="remark">Remark:</label>
                <input type="text" name="remark" required class="form-control" value="{{ $adm_role->remark }}">
            </div>
         
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endif

@endsection 