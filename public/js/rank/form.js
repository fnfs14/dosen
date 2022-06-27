$(document).ready(function () {
    const url = $("meta[name='app-url']").attr("content")
    const form = $("#form-data")
    const isEdit = form.find("#id").length>0 ? true : false
    const uri = isEdit ? "update" : "store"
    const bearerSave = $(`meta[name='bearer-save']`).attr("content")
    const bearerPosition = $("meta[name='bearer-position']").attr("content")

    setSelect2({
        select: form.find("#position"),
        url: `${url}api/position/select2`,
        bearerToken: bearerPosition,
    })

    form.on("submit", (e)=>{
        e.preventDefault()
        $.ajax({
            url: `${url}api/rank/${uri}`,
            type: "post",
            dataType: "json",
            data: {
                name: form.find("#name").val(),
                position: form.find("#position").val(),
                _method: isEdit ? "put" : undefined,
                id: isEdit ? form.find("#id").val() : undefined,
            },
            beforeSend: (xhr) => { xhr.setRequestHeader('Authorization', `Bearer ${bearerSave}`) },
            success: (res) => {
                if(res==true){
                    let method = isEdit ? "mengubah" : "menambahkan"
                    window.localStorage.setItem('store', `Berhasil ${method} pangkat`)
                    window.location.href = url + 'master/rank'
                }else{
                    toastr.error('Terjadi Kesalahan. Harap hubungi Admin','ERROR')
                }
            },
            error: (jqXHR, textStatus, errorThrown) => {
                let message = jqXHR.responseJSON && jqXHR.responseJSON.message ? jqXHR.responseJSON.message : errorThrown
                toastr.error(message,textStatus.toUpperCase())
            },
        })
    })
})
