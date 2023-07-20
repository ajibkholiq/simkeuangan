@extends('layout.master') @section('main')
<div class="row" style="margin-top: 20px">
    <div class="col-lg-12" style="margin-bottom: 30px">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h4>Edit Menu</h4>
                <form
                    method="Post"
                    action="{{Route('adm-menu.update',$data->uuid)}}"
                    class="form-horizontal"
                >
                    @csrf @method("PUT")

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Induk</label>
                        <div class="col-sm-10">
                            <select
                                name="induk"
                                id="induk"
                                class="form-control"
                            >
                                <option value="{{$data->induk}}" class="text-capitalize">{{$data->induk}} </option>
                                <option value="head" class="text-capitalize">head</option>
                                @foreach ($menu as $item)
                                @if ($item->nama_menu != $data->induk && $item->route == "" && $item->induk != $data->induk)
                                <option
                                    value="{{$item->nama_menu}}"
                                    class="text-capitalize"
                                >
                                    {{$item->kode_menu}}. {{$item->nama_menu}}
                                </option>

                                @endif @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kode</label>

                        <div class="col-sm-10">
                            <input
                                type="text"
                                placeholder="Kode Menu"
                                value="{{$data->kode_menu}}"
                                name="kode"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>

                        <div class="col-sm-10">
                            <input
                                type="text"
                                placeholder="Nama Menu"
                                value="{{$data->nama_menu}}"
                                name="nama"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Route </label>

                        <div class="col-sm-10">
                            <input
                                type="text"
                                placeholder="Route"
                                name="route"
                                value="{{$data->route}}"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Remark</label>

                        <div class="col-sm-10">
                            <input
                                type="text"
                                placeholder="Remark"
                                name="remark"
                                value="{{$data->remark}}"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div
                            class="col-sm-10 col-sm-offset-2"
                            style="text-align: end"
                        >
                            <button class="btn btn-primary" type="submit">
                                Edit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection @push('js') 
<script>
</script>
@endpush
