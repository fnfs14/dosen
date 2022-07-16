$(document).ready(function () {
    const url = $("meta[name='app-url']").attr("content")
    const form = $("#form-data")
    const isEdit = form.find("#id").length>0 ? true : false
    const uri = isEdit ? "update" : "store"
    const bearerSave = $(`meta[name='bearer-save']`).attr("content")
    const bearerCollege = $("meta[name='bearer-college']").attr("content")
    const bearerStage = $("meta[name='bearer-stage']").attr("content")

    setSelect2Ajax({
        select: form.find("#college"),
        url: `${url}api/college/select2`,
        bearerToken: bearerCollege,
        placeholder: "Pilih Perguruan Tinggi",
        selected: form.find("#college").attr("pk"),
    })

    setSelect2Ajax({
        select: form.find("#stage"),
        url: `${url}api/stage/select2`,
        bearerToken: bearerStage,
        placeholder: "Pilih Jenjang",
        selected: form.find("#stage").attr("pk"),
        processResults: (item,i)=>{
            return {
                text: item,
                id: item
            }
        },
    })

    form.on("submit", (e)=>{
        e.preventDefault()
        $.ajax({
            url: `${url}api/major/${uri}`,
            type: "post",
            dataType: "json",
            data: {
                name: form.find("#name").val(),
                college: form.find("#college").val(),
                stage: form.find("#stage").val(),
                front_degree: form.find("#front_degree").val(),
                back_degree: form.find("#back_degree").val(),
                _method: isEdit ? "put" : undefined,
                id: isEdit ? form.find("#id").val() : undefined,
            },
            beforeSend: (xhr) => { xhr.setRequestHeader('Authorization', `Bearer ${bearerSave}`) },
            success: (res) => {
                if(res==true){
                    let method = isEdit ? "mengubah" : "menambahkan"
                    window.localStorage.setItem('store', `Berhasil ${method} program studi`)
                    window.location.href = url + 'master/major'
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
