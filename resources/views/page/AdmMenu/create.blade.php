{{-- <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12 " style="margin-bottom: 30px"> --}}
                            <h4>Tambah Menu</h4>        
                            <form method="post" action="{{URL::Route('adm-menu.store')}}"class="form-horizontal">
                                @csrf
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Induk</label>

                                    <div class="col-sm-10"><input type="text" placeholder="Induk" name="induk" class="form-control"></div>
                                </div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Kode</label>

                                    <div class="col-sm-10"><input type="text" placeholder="Kode Menu" name="kode" class="form-control"></div>
                                </div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Nama</label>

                                    <div class="col-sm-10"><input type="text" placeholder="Nama Menu" name="nama" class="form-control"></div>
                                </div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Route </label>

                                    <div class="col-sm-10"><input type="text" placeholder="Route" name="route" class="form-control"></div>
                                </div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Remark</label>

                                    <div class="col-sm-10"><input type="text" placeholder="Remark" name="remark" class="form-control"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-2" style="text-align: end">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                {{-- </div>
            </div> --}}
