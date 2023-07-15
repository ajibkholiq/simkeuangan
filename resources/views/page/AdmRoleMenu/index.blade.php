@extends('layout.master')
@push('css')
<link href="{{ URL::asset ('assets/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
<link href="{{ URL::asset ('assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
@endpush
@section('main')
<div class="row" style="margin-top:10px">
    <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Role</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table">
                            <tbody>
                            @foreach ($role as $item)
                                <tr>
                                <td> <a href="http://" class="text-uppercase">{{$item->nama_role}}</a></td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Menu</h5>
                    </div>
                    <div class="ibox-content">
                        <form action="{{route('adm-role-menu.store')}}" method="POST">
                          @csrf
                            @foreach ($data as $item)
                                @if ($item->induk == "head")
                                    <div style="height: auto ; border:1pt dashed rgb(117, 114, 114) ; padding:20px 20px ; margin:20px 0 ; border-radius: 10px; font-size: 10pt;text-transform: uppercase"   >
                                        <input type="checkbox" name="{{$item->nama_menu}}" value="1" id=""> {{$item->nama_menu}}
                                        @foreach ($data as $sm)
                                            @if ($sm->induk == $item->nama_menu)
                                                <div class="hr-line-dashed"></div>
                                                <input type="checkbox" name="{{$sm->nama_menu}}" value="1" id="" style="margin-left:30px"> {{$sm->nama_menu}}
                                            @endif 
                                        @endforeach
                                    </div>

                                @endif
                                @endforeach
                          
                            <button class="btn btn-primary" type="submit">
                                Edit
                            </button>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script src="{{URL::asset('assets/js/plugins/iCheck/icheck.min.js')}}"></script>
@endpush