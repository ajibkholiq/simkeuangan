@extends('layout.master')
@section('main')
<div class="row" style="margin-top:10px">
          @if ( session('success'))
               <div class="col-lg-12">
                <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <a class="alert-link" href="#">Berhasil.! </a>{{session('success')}} 
                </div>
            </div> 
          @endif
          
            <div class="col-md-12">
                <a data-toggle="modal"href="#add-form" class="btn btn-primary" style="justify-items: end"><i class="fa fa-plus"></i> Add User</a>
            </div>

            <div class="col-lg-12 " style="margin-top: 10px ;margin-bottom: 30px" >
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead >
                                    <tr>
                                        <style>
                                            th{text-align: center;}
                                        </style>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>No HP</th>
                                        <th>Role</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody >
                                        @foreach ($data as $data)
                                        <tr>
                                    
                                        <td >{{$data->id}}</td>
                                        <td>{{$data->nama}}</td>
                                        <td>{{$data->username}}</td>
                                        <td>{{$data->email}}</td>
                                        <td>{{$data->alamat}}</td>
                                        <td>{{$data->nohp}}</td>
                                        <td>{{$data->role}}</td>

                                        <td style="display: flex; justify-content:center; gap: 10px" >
                                            @if ($data->role != 'admin')
                                                {{-- <a href="{{route('adm-menu.edit',$data->uuid)}}" class="btn btn-warning fa fa-pencil"></a> --}}
                                                <a data-toggle="modal" class="btn btn-outline btn-warning fa fa-pencil" id="btn-edit" data-id="{{$data->uuid}}"></a>
                                                <form action="{{route("adm-user.destroy",$data->uuid)}}" method="POST" onsubmit="return confirm('Apakah Anda Yakin ?');">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-outline btn-danger fa fa-trash-o"></button>
                                                </form>
                                            @endif
                                        </td>
                                         </tr> 
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div id="add-form" class="modal in" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        @include('page.AdmUser.create')
                    </div>
                </div>
            </div>
        </div>  
         <div id="edit-form" class="modal in" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        @include('page.AdmUser.edit')
                    </div>
                </div>
            </div>
        </div>   
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
        $('body').on('click','#btn-edit',function (){
            let uuid = $(this).data('id');      
        $.ajax({
            url: '/adm-user/'+uuid,
            type : 'get',
            success: function (data){
                $('#id').val(data.uuid);
                $('#nama').val(data.nama);
                $('#username').val(data.username);
                $('#email').val(data.email);
                $('#nohp').val(data.nohp);
                $('#alamat').val(data.alamat);
                $('#role').val(data.role);
                $('#edit-form').modal('show');
                
            }
           });
          });

        $('#save').on('click', function (){
            let uuid =  $('#id').val();
            console.log(uuid);
            
            $.ajax({
                url: '/adm-user/'+uuid,
                type: 'PUT',
                data : {
                        'nama' : $('#nama').val(),
                        'username' :$('#username').val(),
                        'email' : $('#email').val(),
                        'nohp' : $('#nohp').val(),
                        'alamat' :$('#alamat').val(),
                        'role' : $('#role').val(),
                        '_token' : $("input[name='_token']").val(),
                        '_method' : 'PUT'
                },
                success : function(response){
                    console.log(response);
                    $('#edit-form').modal('hide');
                    setTimeout(function() { location.reload();}, 100);
                }
            });
        });

    
</script>
@endpush