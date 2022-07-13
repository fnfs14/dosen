$(document).ready(function () {
    const bearerDt = $("meta[name='bearer-dt']").attr("content")
    const bearerDestroy = $("meta[name='bearer-destroy']").attr("content")
    const url = $("meta[name='app-url']").attr("content")
    const table = $('#list-major')

    setDatatable({
        url: `${url}api/major/dt`,
        token: bearerDt,
        table: table,
        buttonAddText: "Tambah Program Studi",
        buttonAddUrl: `${url}master/major/create`,
        columns: [
            { data: "no", className: "text-center", sortable: false, },
            { data: "name" },
            { data: "college" },
            { data: "stage" },
            { data: "front_degree" },
            { data: "back_degree" },
            { data: "id" },
        ],
        columnDefs: [
            {
                targets: 6,
                width: "10%",
                className: "text-center",
                orderable: false,
                render: function(data,type,row){
                    return `
                        <div class="btn-group">
                            <a href="${url}master/major/${row.id}/edit" pk="${row.id}" class="btn btn-sm btn-info text-white" title="Ubah ${row.name}">
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
        table: "#list-major",
        url: `${url}api/major/destroy`,
        token: bearerDestroy,
        module: "program studi",
        redirect: `${url}master/major`,
    })

    toastrSuccess('store')
    toastrSuccess('destroy')
})
