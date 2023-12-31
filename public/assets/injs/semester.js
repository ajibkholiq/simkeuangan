let table;
document.addEventListener("DOMContentLoaded", function () {
    table = new DataTable("#data-table", {
        dom: "Bfrtipl",
        buttons: [
            {
                extend: "print",
                title: "Data Semester",
                exportOptions: {
                    columns: [1, 2, 3],
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
            url: "/api/semester",
            type: "GET",
        },
        columns: [
            {
                title: "Action",
                data: null,
                render: function (data, type, row) {
                    var clas;
                    if (data.status === "AKTIF") {
                        clas = "btn-warning fa fa-check-square-o ";
                    } else {
                        clas = "btn-primary fa fa-square-o ";
                    }
                    return `
                    <div style="display:flex; gap:8px; justify-content: start">
                   <button id="bt-hapus" class="btn btn-outline btn-danger fa fa-trash-o" data-id="${data.uuid}"></button> 
                    <button id="bt-edit" class="btn btn-outline ${clas}" data-uuid="${data.uuid}" data-status ="${data.status}" "></button></div>
                   `;
                },
            },
            { title: "Semester", data: "semester" },
            { title: "Status", data: "status" },
            { title: "Keterangan", data: "remark" },
        ],
    });
});
$("body").on("click", "#bt-edit", function () {
    let uuid = $(this).data("uuid");
    let statu = $(this).data("status");
    $.ajax({
        url: "/semester/" + uuid,
        type: "PUT",
        data: {
            status: statu,
            _token: $("input[name='_token']").val(),
            _method: "PUT",
        },
        success: function () {
            if (statu == "AKTIF") {
                toastr.success("Berhasil dinonaktifkan!", "Tahun Pelajaran");
            } else {
                toastr.success("Berhasil diaktifkan!", "Tahun Pelajaran");
            }
            table.ajax.reload();
            table.ajax.reload();
        },
    });
});

$(document).on("click", "#bt-hapus", function () {
    let uuid = $(this).data("id");
    $.ajax({
        url: "/semester/" + uuid,
        type: "DELETE",
        data: {
            _token: $("input[name='_token']").val(),
            _method: "DELETE",
        },
        success: () => {
            toastr.success("Berhasil dihapus!", "Semester");
            table.ajax.reload();
        },
    });
});
