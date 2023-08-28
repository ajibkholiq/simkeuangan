let table;
document.addEventListener("DOMContentLoaded", function () {
    table = new DataTable("#data-table", {
        dom: "Bfrtipl",
        buttons: [
            {
                extend: "excel",
                title: "Data Tagihan Siswa",
                text: '<i class="fa fa-file-excel-o"></i>',
                titleAttr: "Excel",
                autoFilter: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                },
            },
            {
                extend: "print",
                title: "Data Tagihan Siswa",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                },
            },
        ],
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
            url: "/api/dataTagihan",
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
            { title: "Siswa", data: "siswa" },
            { title: "Kelas", data: "kelas" },
            { title: "Tahun Ajaran", data: "tahun_ajaran" },
            { title: "Kode Tagihan", data: "nama" },
            { title: "Kali", data: "kali" },
            { title: "Diskon", data: "diskon" },
            { title: "Nominal", data: "nominal" },
            { title: "Keterangan", data: "remark" },
        ],
    });
});

$("body").on("click", "#bt-edit", function () {
    $.ajax({
        url: "/tagihan_siswa/" + $(this).data("uuid"),
        type: "GET",
        success: (data) => {
            console.log(data)
             $("#uuid").val(data.uuid);
             $("#siswa").val(data.siswa);
             $("#kelas").val(data.kelas);
             $("#thn").val(data.tahun_ajaran);
             $("#tagihan").val(data.nama);
             $("#kali").val(data.kali);
             $("#diskon").val(data.diskon);
             $("#nominal").val(data.nominal);
             $("#remark").val(data.remark);
            $("#edit").modal("show");
        },
    });
});
$("#save").on("click", () => {
    $.ajax({
        url: "/tagihan_siswa/" + $("#uuid").val(),
        type: "PUT",
        data: {
            kali :  $("#kali").val(),
            diskon: $("#diskon").val(),
            nominal:$("#nominal").val(),
            remark: $("#remark").val(),
            _token: $("input[name='_token']").val(),
            _method: "PUT",
        },
        success: (response) => {
            $("#edit").modal("hide");
            toastr.success("Berhasil diubah!", "Tagihan Siswa");
            console.log(response);
            table.ajax.reload();
        },
    });
});
$(document).on("click", "#bt-hapus", function () {
    let uuid = $(this).data("id");
    $.ajax({
        url: "/tagihan_siswa/" + uuid,
        type: "DELETE",
        data: {
            _token: $("input[name='_token']").val(),
            _method: "DELETE",
        },
        success: () => {
            toastr.success("Berhasil dihapus!", "Tagihan Siswa");
            table.ajax.reload();
        },
    });
});
