$(document).ready(function () {
    const bearerSave = $("meta[name='bearer-save']").attr("content")
    const bearerPosition = $("meta[name='bearer-position']").attr("content")
    const url = $("meta[name='app-url']").attr("content")
    const form = $("#form-data")
    const isEdit = form.find("#id").length>0 ? true : false
    const uri = isEdit ? "update" : "store"

    setSelect2Ajax({
        select: form.find("#position"),
        url: `${url}api/position/select2`,
        bearerToken: bearerPosition,
        placeholder: "Pilih Jabatan",
        selected: form.find("#position").attr("pk"),
    })

    form.on("submit", (e)=>{
        e.preventDefault()
        let formData = new FormData()
            formData.append('user', form.find("#user").val())
            formData.append('position', form.find("#position").val())
            formData.append('file', form.find("#file")[0].files[0])
        if(isEdit){
            formData.append('id', form.find("#id").val())
            formData.append('_method', "put")
        }
        console.log(form.find("#file")[0].files[0])
        form.find(".requirement").map((i,v)=>{
            v = $(v)
            formData.append(v.attr("name"), v[0].files[0])
        })
        $.ajax({
            url: `${url}api/promote/${uri}`,
            type: "post",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            beforeSend: (xhr) => { xhr.setRequestHeader('Authorization', `Bearer ${bearerSave}`) },
            success: (res) => {
                if(res==true){
                    window.localStorage.setItem('store', `Berhasil menyimpan pengajuan promosi`)
                    window.location.href = url + 'promote'
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
