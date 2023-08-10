;

 document.addEventListener("DOMContentLoaded", function () {
     let table = new DataTable("#data-table", {
         processing: false,
         ordering: true,
         lengthMenu: [
             [10, 25, 50, -1],
             [10, 25, 50, "All"],
         ],
         language: {
             emptyTable: "Tidak ada data",
         },
         ajax: {
             url: "/api/getSiswa",
             type: "GET",
         },
         columns: [
             {
                 title: "Action",
                 data: null,
                 render: function (data, type, row) {
                     return `
                    <div style="display:flex; gap:8px; justify-content: center">
                   <button id="bt-hapus" class="btn btn-outline btn-danger fa fa-trash-o" data-id="${data.uuid}"></button> 
                    <button id="bt-edit" class="btn btn-outline btn-warning fa fa-pencil " data-uuid="${data.uuid}"></button></div>
                   `;
                 },
             },
             { title: "NIS", data: "nis" },
             { title: "Nama", data: "nama" },
             { title: "Kelas", data: "kelas" },
             { title: "Nama Ayah", data: "nama_ayah" },
             { title: "Nama Ibu", data: "nama_ibu" },
             { title: "No Hp", data: "no_hp" },
             {
                 title: "Alamat",
                 data: null,
                 render: (data) => {
                     return `${data.alamat_detail}, Desa ${data.kelurahan}, Kecamatan ${data.kecamatan}, ${data.kabupaten}, ${data.provinsi} `;
                 },
             },
             { title: "Keterangan", data: "remark" },
         ],
     });
     $.ajax({
         url: "/api/getprovinsi",
         type: "GET",
         success: (data) => {
             $.each(data, (i, val) => {
                 $("#provinsi").append(
                     ` <option value="${val.name}">${val.name}</option> `
                 );
                 $("#provinsiEdit").append(
                     ` <option value="${val.name}">${val.name}</option> `
                 );
             });
         },
     });
 });
$("#provinsi").change(() => {const provinsi = $("#provinsi").val();$.ajax({url: "/api/getkabupaten/" + provinsi,type: "GET",success: (data) => {$("#kabupaten").empty();$.each(data, (i, val) => {$("#kabupaten").append(`<option value="${val.name}">${val.name}</option>`);});},});});
$("#kabupaten").change(() => {$.ajax({url: "/api/getkecamatan/" + $("#kabupaten").val(),type: "GET",success: (data) => {$("#kecamatan").empty();$.each(data, (i, val) => {$("#kecamatan").append(` <option value="${val.name}">${val.name}</option>  `);});},});});
$("#kecamatan").change(() => {$.ajax({url: "/api/getkelurahan/" + $("#kecamatan").val(),type: "GET",success: (data) => {$("#kelurahan").empty();$.each(data, (i, val) => {$("#kelurahan").append(`<option  value="${val.name}">${val.name}</option>`);});},});});
$("#provinsiEdit").change(() => {const provinsi = $("#provinsiEdit").val();$.ajax({url: "/api/getkabupaten/" + provinsi,type: "GET",success: (data) => {$("#kabupatenEdit").empty();$.each(data, (i, val) => {$("#kabupatenEdit").append(` <option value="${val.name}">${val.name}</option>`);});},});});
$("#kabupatenEdit").change(() => {$.ajax({url: "/api/getkecamatan/" + $("#kabupatenEdit").val(),type: "GET",success: (data) => {$("#kecamatanEdit").empty();$.each(data, (i, val) => {$("#kecamatanEdit").append(`<option value="${val.name}">${val.name}</option>`);});},});});
$("#kecamatanEdit").change(() => {$.ajax({url: "/api/getkelurahan/" + $("#kecamatanEdit").val(),type: "GET",success: (data) => {$("#kelurahanEdit").empty();$.each(data, (i, val) => {$("#kelurahanEdit").append(` <option  value="${val.name}">${val.name}</option>  `);});},});});
$("#btn-add").click(() => {$('#add-siswa').modal('show');});
$(document).on("click", "#bt-hapus", function () {
    let uuid = $(this).data("id");
    $.ajax({
        url: "/siswa/" + uuid,
        type: "DELETE",
        data: {
            _token: $("input[name='_token']").val(),
            _method: "DELETE",
        },
        success: () => {
         setTimeout(() => {
           location.reload();
         }, 100);
        },
    });
});
var uuid;
$("body").on("click", "#bt-edit", function () {
    $("#edit-alamat").hide();
    $.ajax({
        url: "/siswa/" + $(this).data("uuid"),
        type: "GET",
        success: (data) => {
            uuid = data.uuid;
            $("#nama").val(data.nama);
            $("#ayah").val(data.nama_ayah);
            $("#ibu").val(data.nama_ibu);
            $("#nohp").val(data.no_hp);
            $("#alamat").val(data.alamat_detail);
            $("#remark").val(data.remark);
            $("#edit-siswa").modal("show");
        },
    });
});
$("#show-alamat").click(function () {
    $("#edit-alamat").show();
});
$("#ubahsiswa").click(function () {
    $.ajax({
        url: "/siswa/" + uuid,
        type: "PUT",
        data: {
            nama: $("#nama").val(),
            ayah: $("#ayah").val(),
            ibu: $("#ibu").val(),
            nohp: $("#nohp").val(),
            alamat: $("#alamat").val(),
            kelas: $("#kelasEdit").val(),
            provinsi: $("#provinsiEdit").val(),
            kabupaten: $("#kabupatenEdit").val(),
            kecamatan: $("#kecamatanEdit").val(),
            kelurahan: $("#kelurahanEdit").val(),
            remark: $("#remark").val(),
            _token: $("input[name='_token']").val(),
            _method: "PUT",
        },
        success: (response) => {
            $("#edit-siswa").modal("hide");
            console.log(response);
            setTimeout(() => {
                location.reload();
            }, 100);
        },
    });
});


