$(document).ready(function () {
    const token = $("meta[name='bearer-token']").attr("content")
    const url = $("meta[name='app-url']").attr("content")
    const table = $('#list-lecturer')

    setDatatable({
        url: `${url}api/user/dt`,
        token: token,
        table: table,
        buttonAddText: "Tambah Dosen",
        buttonAddUrl: `${url}lecturer/create`,
        createdRow: (row, data, dataIndex)=>{
            $(row)
                .css("cursor","pointer")
                .on("click",()=>{
                    window.location.href = `${url}promote/u/${data.id}`
                })
        },
    })

    toastrSuccess('store')
})
