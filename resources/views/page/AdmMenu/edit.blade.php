 <h4>Edit Menu</h4>        
                            <div class="form-horizontal">
                                @csrf
                                @method("PUT")
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Induk</label>
                                    <input type="hidden" id="uuid">
                                    <div class="col-sm-10">
                                        <select name="induk" id="induk" class="form-control">
                                            <option value="head">Head</option>
                                            @foreach ($menu as $item)
                                            @if ($item->induk == 'head' &&  $item->route =="")
                                                <option value="{{$item->nama_menu}}" class="text-capitalize">{{$item->kode_menu}}. {{$item->nama_menu}}</option>
                                                
                                            @endif
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                 </div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Kode</label>

                                    <div class="col-sm-10"><input type="text" placeholder="Kode Menu" id="kode" name="kode" required class="form-control"></div>
                                </div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Nama</label>

                                    <div class="col-sm-10"><input type="text" placeholder="Nama Menu" name="nama" id="nama" required class="form-control"></div>
                                </div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Route </label>

                                    <div class="col-sm-10"><input type="text" placeholder="Route" name="route" id="route"  class="form-control"></div>
                                </div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Remark</label>

                                    <div class="col-sm-10"><input type="text" placeholder="Remark" name="remark" required id="remark" class="form-control"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-2" style="text-align: end">
                                        <button class="btn btn-primary" id="edit" type="submit">Ubah</button>
                                    </div>
                                </div>
                            </div>