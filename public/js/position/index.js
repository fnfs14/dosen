$(document).ready(function () {
    const table = $('#list-position')
    const bearerDt = $("meta[name='bearer-dt']").attr("content")
    const bearerDestroy = $("meta[name='bearer-destroy']").attr("content")
    const url = $("meta[name='app-url']").attr("content")

    setDatatable({
        url: `${url}api/position/dt`,
        token: bearerDt,
        table: table,
        buttonAddText: "Tambah Jabatan",
        buttonAddUrl: `${url}master/position/create`,
        columns: [
            { data: "no", className: "text-center", sortable: false, },
            { data: "name" },
            { data: "id" },
        ],
        columnDefs: [
            {
                targets: 2,
                width: "10%",
                className: "text-center",
                orderable: false,
                render: function(data,type,row){
                    return `
                        <div class="btn-group">
                            <a href="${url}master/position/${row.id}/edit" pk="${row.id}" class="btn btn-sm btn-info text-white" title="Ubah ${row.name}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="button" pk="${row.id}" class="btn btn-sm btn-danger" title="Hapus ${row.name}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>`
                },
            }
        ],
        createdRow: function( row, data, dataIndex ) {
            $(row).attr("pk",data.id)
        },
    })

    setDelete({
        table: "#list-position",
        url: `${url}api/position/destroy`,
        token: bearerDestroy,
        module: "jabatan",
        redirect: `${url}master/position`,
    })

    toastrSuccess('store')
    toastrSuccess('destroy')
})
