@extends('layout.master')

@section('main')
<div class="row" style="margin-top:10px">
    <div class="col-md-12">
    @if ( session('success'))
         <div class="col-lg-12">
          <div class="alert alert-success alert-dismissable">
                          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                          <a class="alert-link" href="#">Berhasil.! </a>, {{session('success')}} 
          </div>
      </div> 
    @endif
</div>
<div class="col-md-12">
<a href="#" class="btn btn-primary float-right" style="margin-top: 10px" data-toggle="modal" data-target="#addRoleModal"><i class="fa fa-plus"></i> Add Role</a>
</div>
<!-- Modal -->


<div class="col-md-12">
<div class="ibox float-e-margins">
    <div class="ibox-content" style="margin-top: 10px">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <style>
                        th {
                            text-align: center;
                            font-size: 10pt;
                        }
                    </style>
                    <tr>
                        <th>Nama Role</th>
                        <th>Remark</th>
                        <th>Create_by</th>
                        <th>Update_by</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @foreach ($adm_roles as $adm_role)
                        <tr>
                            <td>{{ $adm_role->nama_role }}</td>
                            <td>{{ $adm_role->remark }}</td>
                            <td>{{ $adm_role->create_by }}</td>
                            <td>{{ $adm_role->update_by }}</td>
                           
                            <td>
                                <a href="{{ route('adm-role.edit', $adm_role->uuid) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                <form action="{{ route('adm-role.destroy', $adm_role->uuid) }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
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
                <form action="{{ route('adm-role.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nama_role">Nama Role:</label>
                        <input type="text" name="nama_role" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="remark">Remark:</label>
                        <input type="text" name="remark" required class="form-control">
                    </div>
                    <!-- Tambahkan elemen input lainnya sesuai dengan kebutuhan Anda -->
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> Add</button>
                </form>
            </div>
        </div>
    </div>
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

