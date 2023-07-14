@extends('layout.master')

@section('main')
@if ($errors->any())
<div class="pt-3">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $item)
                <li>
                    {{ $item }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<a href="{{ route('adm_role.create') }}" class="btn btn-primary float-right" style="margin-top: 10px" data-toggle="modal" data-target="#addRoleModal"><i class="fa fa-plus"></i> Add Role</a>

<!-- Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" role="dialog" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoleModalLabel">Add Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulir tambah role -->
                <form action="{{ route('adm_role.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="uuid">UUID:</label>
                        <input type="text" name="uuid" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama_role">Nama Role:</label>
                        <input type="text" name="nama_role" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="remark">Remark:</label>
                        <input type="text" name="remark" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="create_by">Create_by:</label>
                        <input type="text" name="create_by" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="update_by">Update_by:</label>
                        <input type="text" name="update_by" class="form-control">
                    </div>
                    <!-- Tambahkan elemen input lainnya sesuai dengan kebutuhan Anda -->
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> Add</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="ibox float-e-margins">
    <div class="ibox-content" style="margin-top: 10px">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>UUID</th>
                        <th>Nama Role</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($adm_roles as $adm_role)
                        <tr>
                            <td>{{ $adm_role->id }}</td>
                            <td>{{ $adm_role->uuid }}</td>
                            <td>{{ $adm_role->nama_Role }}</td>
                            <td>{{ $adm_role->remark }}</td>
                            <td>
                                <a href="{{ route('adm_role.edit', $adm_role->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                <form action="{{ route('adm_role.destroy', $adm_role->id) }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
<script>
    $(document).ready(function() {
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.success('Role created successfully', 'Notification');
        }, 1300);    
        });
        
    </script>

