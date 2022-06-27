function setDelete(p={}){
    const table = p.table
    const url = p.url
    const token = p.token
    const module = p.module
    const redirect = p.redirect

    $(document).on("click", `${table} .btn-danger`, (e)=>{
        let target = $(e.target)
            target = target.hasClass("btn-danger") ? target : target.parent()
        if(target.length<=0){ return }
        let pk = target.attr("pk")
        let name = target.attr("title").replace("Delete ","")
        swal({
            title: "Anda sangat yakin?",
            text: `Setelah dihapus, Anda tidak dapat memulihkan data '${name}'`,
            icon: "warning",
            buttons: ["Batal", "Hapus"],
            dangerMode: true,
        }).then(name => {
            if (!name) return;
            return $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                data: {
                    _method: "delete",
                    id: pk,
                },
                beforeSend: (xhr) => { xhr.setRequestHeader('Authorization', `Bearer ${token}`) },
                success: (res) => {
                    if(res==true){
                        window.localStorage.setItem('destroy', `Berhasil menghapus ${module}`)
                        window.location.href = redirect
                    }else if(res=="major"){
                        toastr.error('Tidak dapat menghapus data. Data digunakan pada Master Data Program Studi','ERROR')
                    }else if(res=="rank"){
                        toastr.error('Tidak dapat menghapus data. Data digunakan pada Master Data Pangkat','ERROR')
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
}
