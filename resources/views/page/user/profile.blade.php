@extends('layout.master')
@section('main')
<div class="row m-b-lg m-t-lg ">
                <div class="col-md-4 center ">
                    
                </div>
                    <div class="col-lg-12 " style="margin-bottom: 30px">
                        <div class="ibox float-e-margins" style="margin: 20px 0">
                            <div class="ibox-content">
                           <form method="post" action="{{URL::Route('adm-user.store')}}"class="form-horizontal">
                                @csrf
                                <div class="hr-line-dashed"></div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Nama</label>

                                    <div class="col-sm-10"><input type="text" placeholder="Nama" name="nama" class="form-control"></div>
                                </div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Username </label>

                                    <div class="col-sm-10"><input type="text" placeholder="Username" name="username" class="form-control"></div>
                                </div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Password</label>

                                    <div class="col-sm-10"><input type="password" placeholder="Password" name="password" class="form-control"></div>
                                </div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10"><input type="email" placeholder="Email" name="email" class="form-control"></div>
                                </div>
                                 <div class="form-group"><label class="col-sm-2 control-label">No HP</label>
                                    <div class="col-sm-10"><input type="text" placeholder="HP" name="nohp" class="form-control"></div>
                                </div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-10"><input type="text" placeholder="Alamat" name="alamat" class="form-control"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-2" style="text-align: end">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
    </div></div>
                    </div>
                </div>
@endsection