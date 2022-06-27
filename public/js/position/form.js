$(document).ready(function () {
    const token = $("meta[name='bearer-token']").attr("content")
    const url = $("meta[name='app-url']").attr("content")
    const form = $("#form-data")
    const isEdit = form.find("#id").length>0 ? true : false
    const uri = isEdit ? "update" : "store"

    form.on("submit", (e)=>{
        e.preventDefault()
        $.ajax({
            url: `${url}api/position/${uri}`,
            type: "post",
            dataType: "json",
            data: {
                name: $("#name").val(),
                _method: isEdit ? "put" : undefined,
                id: isEdit ? form.find("#id").val() : undefined,
            },
            beforeSend: (xhr) => { xhr.setRequestHeader('Authorization', `Bearer ${token}`) },
            success: (res) => {
                if(res==true){
                    let method = isEdit ? "mengubah" : "menambahkan"
                    window.localStorage.setItem('store', `Berhasil ${method} jabatan`)
                    window.location.href = url + 'master/position'
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
