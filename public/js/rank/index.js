$(document).ready(function () {
    const bearerDt = $("meta[name='bearer-dt']").attr("content")
    const bearerDestroy = $("meta[name='bearer-destroy']").attr("content")
    const url = $("meta[name='app-url']").attr("content")
    const table = $('#list-rank')

    setDatatable({
        url: `${url}api/rank/dt`,
        token: bearerDt,
        table: table,
        buttonAddText: "Tambah Pangkat",
        buttonAddUrl: `${url}master/rank/create`,
        columns: [
            { data: "no", className: "text-center", sortable: false, },
            { data: "name" },
            { data: "position" },
            { data: "id" },
        ],
        columnDefs: [
            {
                targets: 3,
                width: "10%",
                className: "text-center",
                orderable: false,
                render: function(data,type,row){
                    return `
                        <div class="btn-group">
                            <a href="${url}master/rank/${row.id}/edit" pk="${row.id}" class="btn btn-sm btn-info text-white" title="Ubah ${row.name}">
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
        table: "#list-rank",
        url: `${url}api/rank/destroy`,
        token: bearerDestroy,
        module: "pangkat",
        redirect: `${url}master/rank`,
    })

    toastrSuccess('store')
    toastrSuccess('destroy')
})
