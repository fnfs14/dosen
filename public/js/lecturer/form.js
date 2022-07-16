$(document).ready(function () {
    const form = $("#form-data")
    const isEdit = form.find("#id").length>0 ? true : false
    const token = $("meta[name='bearer-token']").attr("content")
    const url = $("meta[name='app-url']").attr("content")
    const uri = isEdit ? "update" : "store"

    setSelect2(form.find("#gender"),{
        placeholder: "Pilih Jenis Kelamin",
    })

    form.find("#birth_date").datepicker({
        todayBtn: "linked",
        toggleActive: true,
        todayHighlight: true,
        format: "yyyy-mm-dd",
    })

    form.on("submit", (e)=>{
        e.preventDefault()
        $.ajax({
            url: `${url}api/user/${uri}`,
            type: "post",
            dataType: "json",
            data: {
                name: $("#name").val(),
                email: $("#email").val(),
                gender: $("#gender").val(),
                birth_place: $("#birth_place").val(),
                birth_date: $("#birth_date").val(),
                _method: isEdit ? "put" : undefined,
                id: isEdit ? form.find("#id").val() : undefined,
            },
            beforeSend: (xhr) => { xhr.setRequestHeader('Authorization', `Bearer ${token}`) },
            success: (res) => {
                if(res==true){
                    window.localStorage.setItem('store', 'Berhasil menambahkan dosen')
                    window.location.href = url + 'master/lecturer'
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
