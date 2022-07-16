$(document).ready(function () {
    const url = $("meta[name='app-url']").attr("content")
    const form = $("#form-data")
    const isEdit = form.find("#id").length>0 ? true : false
    const uri = isEdit ? "update" : "store"
    const bearerSave = $(`meta[name='bearer-save']`).attr("content")
    const bearerRank = $("meta[name='bearer-rank']").attr("content")

    setSelect2Ajax({
        select: form.find("#rank"),
        url: `${url}api/rank/select2`,
        bearerToken: bearerRank,
        placeholder: "Pilih Pangkat",
        selected: form.find("#rank").attr("pk"),
    })

    form.on("submit", (e)=>{
        e.preventDefault()
        $.ajax({
            url: `${url}api/level/${uri}`,
            type: "post",
            dataType: "json",
            data: {
                name: form.find("#name").val(),
                rate: form.find("#rate").val(),
                rank: form.find("#rank").val(),
                _method: isEdit ? "put" : undefined,
                id: isEdit ? form.find("#id").val() : undefined,
            },
            beforeSend: (xhr) => { xhr.setRequestHeader('Authorization', `Bearer ${bearerSave}`) },
            success: (res) => {
                if(res==true){
                    let method = isEdit ? "mengubah" : "menambahkan"
                    window.localStorage.setItem('store', `Berhasil ${method} golongan`)
                    window.location.href = url + 'master/level'
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
