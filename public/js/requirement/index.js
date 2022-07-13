$(document).ready(function () {
    const table = $('#list-requirement')
    const bearerDt = $("meta[name='bearer-dt']").attr("content")
    const bearerDestroy = $("meta[name='bearer-destroy']").attr("content")
    const url = $("meta[name='app-url']").attr("content")

    setDatatable({
        url: `${url}api/requirement/dt`,
        token: bearerDt,
        table: table,
        buttonAddText: "Tambah Persyaratan",
        buttonAddUrl: `${url}master/requirement/create`,
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
                            <a href="${url}master/requirement/${row.id}/edit" pk="${row.id}" class="btn btn-sm btn-info text-white" title="Ubah ${row.name}">
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
        table: "#list-requirement",
        url: `${url}api/requirement/destroy`,
        token: bearerDestroy,
        module: "persyaratan",
        redirect: `${url}master/requirement`,
    })

    toastrSuccess('store')
    toastrSuccess('destroy')
})
