document.addEventListener("DOMContentLoaded",function(){
    let table = new DataTable("#data-table",{
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
            url: "api/akun_head_sub",
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
            { title: "Akun Head Sub", data: "akun_head_sub" },
            { title: "Akun Head", data: "akun_head" },
            { title: "Urut", data: "urut" },
            { title: "keterangan", data: "remark" },
            
        ],
       
    });
});
$("#btn-add").click(() => {
    $("#add-siswa").modal("show");
});

$(document).on("click", "#bt-hapus", function () {
    let uuid = $(this).data("id");
    $.ajax({
        url: "/akun_head_sub/" + uuid,
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
        url: "/akun_head_sub/" + $(this).data("uuid"),
        type: "GET",
        success: (data) => {
            uuid = data.uuid;
            $("#akun_head_sub").val(data.akun_head_sub);
            $("#akun_head_id").val(data.akun_head_id);
            $("#urut").val(data.urut);
            $("#remark").val(data.remark);
            $("#edit-akun_headsub").modal("show");
        },
    });
});
$("#ubahsiswa").click(function () {
    $.ajax({
        url: "/akun_head_sub/" + uuid,
        type: "PUT",
        data: {
            akun_head_sub: $("#akun_head_sub").val(),
            akun_head: $("#akun_head_id").val(),
            urut: $("#urut").val(),
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
