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
    @if(session('fail'))
            <div class="col-lg-12">
                <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <a class="alert-link" href="#">Gagal! </a>{{session('fail')}} 
                </div>
            </div>
        @endif
          <div class="col-lg-12 " >
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                        <style>
                                            th{text-align: center;}
                                        </style>
                                        <th>#</th>
                                        <th style="width: 20%;">Role</th>
                                        <th>Daftar Menu</th>
                                    </thead>
                                    <tbody style="text-align: center; text-transform:uppercase"  >
                                        @foreach ($role as $item)
                                        <tr>
                                            <td>#</td>
                                            <td>{{$item->nama_role}}</td>
                                            <td> 
                                            @foreach ($test as $tem)
                                            @if ($tem->nama_role == $item->nama_role )
                                                ({{$tem->nama_menu}}) 
                                            @endif
                                            @endforeach
                                           </td>
                                        </tr> 
                                        @endforeach
                                        
                                    
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Role</h5>
                    </div>
                    <div class="ibox-content">
                        <form action="{{route('adm-role-menu.store')}}" method="POST">
                            @foreach ($role as $item)
                                    <div style="height: auto ; border:1pt dashed rgb(117, 114, 114) ; padding:10px 0 ; margin:20px 0; border-radius: 10px; font-size: 10pt;text-transform: uppercase"   >
                                        <input type="checkbox" name="idRole[]" value="{{$item->id}}"  style="margin-left:30px"> {{$item->nama_role}}
                                    </div>    
                            @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Menu</h5>
                    </div>
                    <div class="ibox-content">
                          @csrf
                            @foreach ($data as $item)
                                @if ($item->induk == "head")
                                    <div style="height: auto ; border:1pt dashed rgb(117, 114, 114) ; padding:20px 20px ; margin:20px 0 ; border-radius: 10px; font-size: 10pt;text-transform: uppercase"   >
                                        <input type="checkbox" name="idMenu[]" value="{{$item->id}}"> {{$item->nama_menu}}
                                        @foreach ($data as $sm)
                                            @if ($sm->induk == $item->nama_menu)
                                                <div class="hr-line-dashed"></div>
                                                <input type="checkbox" name="idMenu[]" value="{{$sm->id}}" style="margin-left:30px"> {{$sm->nama_menu}}
                                            @endif 
                                        @endforeach
                                    </div>

                                @endif
                                @endforeach
                          
                            <button class="btn btn-primary text-end" type="submit">
                                Edit
                            </button>
                        
                        </form>
                    </div>
                </div>
            </div>

             
        </div>
@endsection

@push('js')
@endpush