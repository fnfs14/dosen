$(document).ready(function () {
    const token = $("meta[name='bearer-token']").attr("content")
    const url = $("meta[name='app-url']").attr("content")
    const table = $('#list-lecturer')

    setDatatable({
        url: `${url}api/user/dt`,
        token: token,
        table: table,
        buttonAddText: "Tambah Dosen",
        buttonAddUrl: `${url}master/lecturer/create`,
        columns: [
            { data: "no", className: "text-center", sortable: false, },
            { data: "name" },
            { data: "id" },
        ],
        columnDefs: [
            {
                targets: 2,
                width: "15%",
                className: "text-center",
                orderable: false,
                render: function(data,type,row){
                    var badge = `<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">${row.promote}</span>`
                    return `
                        <div class="btn-group">
                            <a href="${url}master/lecturer/${row.id}/edit" pk="${row.id}" class="btn btn-sm btn-info text-white" title="Ubah ${row.name}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="${url}promote/u/${row.id}" class="btn btn-sm btn-success text-white" title="Ubah ${row.name}">
                                Promote
                                ${ row.promote>0 ? badge : ""}
                            </a>
                        </div>`
                },
            }
        ],
    })

    toastrSuccess('store')
})
