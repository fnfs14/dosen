$(document).ready(function () {
    const table = $('#list-promote')
    const bearerDt = $("meta[name='bearer-dt']").attr("content")
    const url = $("meta[name='app-url']").attr("content")
    const status = $("meta[name='promote-status']").attr("content")

    setDatatable({
        url: `${url}api/promote/dt?status=${status}`,
        token: bearerDt,
        table: table,
        order: [[2,'desc']],
        columns: [
            { data: "no", className: "text-center", sortable: false, },
            { data: "position" },
            { data: "created_at" },
            { data: "time", className: "text-center", sortable: false, },
            { data: "file" },
            { data: "status" },
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
                            <a href="${data}" class="btn btn-sm btn-primary text-white" target="_blank">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>`
                },
            },
            {
                targets: 5,
                width: "10%",
                className: "text-center",
                orderable: false,
                render: function(data,type,row){
                    var method = "light"
                        method = data=="Draf" ? "info" : method
                        method = data=="Diajukan" ? "primary" : method
                        method = data=="Ditolak" ? "danger" : method
                        method = data=="Disetujui" ? "success" : method
                    return `<span class="badge bg-${method}">${data}</span>`
                },
            },
            {
                targets: 6,
                width: "10%",
                className: "text-center",
                orderable: false,
                render: function(data,type,row){
                    return `
                        <div class="btn-group">
                            <a href="${url}promote/s/${row.id}" class="btn btn-sm btn-info text-white" title="Tampilkan Data">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>`
                },
            },
        ],
        createdRow: function( row, data, dataIndex ) {
            $(row).attr("pk",data.id)
        },
    })

    toastrSuccess('store')
    toastrSuccess('destroy')
    toastrSuccess('status')
    toastrWarning('warning')
})
