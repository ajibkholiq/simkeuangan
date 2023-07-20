@extends("layout.master")
{{-- @push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endpush --}}
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
                <a data-toggle="modal"href="#add-form" class="btn btn-primary" style="justify-items: end"><i class="fa fa-plus"></i> Add Menu</a>
            </div>

            <div class="col-lg-12 " style="margin-top: 10px ;margin-bottom: 30px" >
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped "style="text-align: center;">
                                    <thead >
                                    <tr>
                                        <style>
                                            th{text-align: center;}
                                        </style>
                                        <th>ID</th>
                                        <th>Induk</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Route</th>
                                        <th>Remark</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody >
                                        @foreach ($data as $data)
                                        <tr>
                                    
                                        <td >{{$data->id}}</td>
                                        <td>{{$data->induk}}</td>
                                        <td>{{$data->kode_menu}}</td>
                                        <td>{{$data->nama_menu}}</td>
                                        <td>{{$data->route}}</td>
                                        <td>{{$data->remark}}</td>

                                        <td style="display: flex; justify-content:center; gap: 10px" >
                                            <a href="{{route('adm-menu.edit',$data->uuid)}}" class="btn btn-warning fa fa-pencil"></a>
                                        {{-- <a data-toggle="modal"href="#edit" data-menu="$(menu)"class="btn btn-warning fa fa-pencil" ></a> --}}
                                            
                                            <form action="{{route("adm-menu.destroy",$data->uuid)}}" method="POST" onsubmit="return confirm('Apakah Anda Yakin ?');">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-danger fa fa-trash-o"></button>
                                            </form>
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
                                          @include('page.AdmMenu.create')
                                    </div>
                                    </div>
                                </div>
                            </div>     
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
  $('body').on('click', '#btn-edit', function () {

        let post_id = $(this).data('id');
        console.log(post_id);
        //fetch detail post with ajax
        $.ajax({
            url: "/api/menu/"+post_id,
            type: "GET",
            success:function(data){
                $('#kode').val(data.kode_menu);
                $('#nama').val(data.nama_menu);
                $('#route').val(data.route);
                $('#remark').val(data.remark);

                $('#edit-modal').modal
               
            }
        });
    });
    </script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>  --}}
@endpush