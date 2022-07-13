$(document).ready(function () {
    const bearerDt = $("meta[name='bearer-dt']").attr("content")
    const bearerDestroy = $("meta[name='bearer-destroy']").attr("content")
    const url = $("meta[name='app-url']").attr("content")
    const table = $('#list-level')

    setDatatable({
        url: `${url}api/level/dt`,
        token: bearerDt,
        table: table,
        buttonAddText: "Tambah Golongan",
        buttonAddUrl: `${url}master/level/create`,
        columns: [
            { data: "no", className: "text-center", sortable: false, },
            { data: "name" },
            { data: "rate" },
            { data: "rank" },
            { data: "id" },
        ],
        columnDefs: [
            {
                targets: 4,
                width: "10%",
                className: "text-center",
                orderable: false,
                render: function(data,type,row){
                    return `
                        <div class="btn-group">
                            <a href="${url}master/level/${row.id}/edit" pk="${row.id}" class="btn btn-sm btn-info text-white" title="Ubah ${row.name}">
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
        table: "#list-level",
        url: `${url}api/level/destroy`,
        token: bearerDestroy,
        module: "golongan",
        redirect: `${url}master/level`,
    })

    toastrSuccess('store')
    toastrSuccess('destroy')
})
