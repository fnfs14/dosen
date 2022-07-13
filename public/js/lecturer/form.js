$(document).ready(function () {
    const token = $("meta[name='bearer-token']").attr("content")
    const url = $("meta[name='app-url']").attr("content")
    const form = $("#form-data")

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
            url: url + "api/user/store",
            type: "post",
            dataType: "json",
            data: {
                name: $("#name").val(),
                email: $("#email").val(),
                gender: $("#gender").val(),
                birth_place: $("#birth_place").val(),
                birth_date: $("#birth_date").val(),
            },
            beforeSend: (xhr) => { xhr.setRequestHeader('Authorization', `Bearer ${token}`) },
            success: (res) => {
                if(res==true){
                    window.localStorage.setItem('store', 'Berhasil menambahkan dosen')
                    window.location.href = url + 'lecturer'
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
