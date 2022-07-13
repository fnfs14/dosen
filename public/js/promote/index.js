$(document).ready(function () {
    const table = $('#list-promote')
    const bearerDt = $("meta[name='bearer-dt']").attr("content")
    const bearerDestroy = $("meta[name='bearer-destroy']").attr("content")
    const bearerProcess = $("meta[name='bearer-process']").attr("content")
    const url = $("meta[name='app-url']").attr("content")
    const user = $("meta[name='promote-user']").attr("content")
    const isAdmin = $("meta[name='is-admin']").attr("content")

    setDatatable({
        url: `${url}api/promote/dt?user=${user}`,
        token: bearerDt,
        table: table,
        buttonAddText: "Mengajukan Promosi",
        buttonAddUrl: `${url}promote/create`,
        order: [[1,'desc']],
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
                        method = data=="Diproses" ? "primary" : method
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
                    var btn = ""
                    if(isAdmin=="1" && row.status=="Diproses"){
                        btn = `
                            <a href="${url}promote/s/${row.id}" class="btn btn-sm btn-info text-white" title="Tampilkan Data">
                                <i class="fa fa-eye"></i>
                            </a>`
                    }else if(isAdmin!="1" && (row.status=="Draf" || row.status=="Ditolak")){
                        btn = `
                            <button type="button" pk="${row.id}" class="btn btn-sm btn-primary status-process" title="Ajukan">
                                Ajukan
                            </button>
                            <a href="${url}promote/${row.id}/edit" pk="${row.id}" class="btn btn-sm btn-info text-white" title="Ubah">
                                <i class="fa fa-edit"></i>
                            </a>`
                    }
                    return `
                        <div class="btn-group">
                            ${btn}
                        </div>`
                },
            },
        ],
        createdRow: function( row, data, dataIndex ) {
            $(row).attr("pk",data.id)
        },
    })

    setDelete({
        table: "#list-promote",
        url: `${url}api/promote/destroy`,
        token: bearerDestroy,
        module: "pengajuan promosi",
        redirect: `${url}promote`,
    })

    setStatus({
        table: "#list-promote",
        url: `${url}api/promote/process`,
        token: bearerProcess,
        redirect: `${url}promote`,
        target: `status-process`,
        text: "Draf ini akan diajukan",
        textSuccess: "Draf berhasil diajukan",
    })

    toastrSuccess('store')
    toastrSuccess('destroy')
    toastrSuccess('status')
    toastrWarning('warning')
})
