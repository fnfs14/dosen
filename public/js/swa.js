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
                    let exc = {
                        major : "Master Data Program Studi",
                        rank : "Master Data Pangkat",
                        level : "Master Data Golongan",
                    }
                    if(res==true){
                        window.localStorage.setItem('destroy', `Berhasil menghapus ${module}`)
                        window.location.href = redirect
                    }else if(res in exc){
                        toastr.error(`Tidak dapat menghapus data. Data digunakan pada ${exc[res]}`,'ERROR')
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

function setStatus(p={}){
    const table = p.table
    const url = p.url
    const token = p.token
    const redirect = p.redirect
    const targetBtn = p.target
    const text = p.text
    const textSuccess = p.textSuccess

    $(document).on("click", `${table} .${targetBtn}`, (e)=>{
        let target = $(e.target)
            target = target.hasClass(targetBtn) ? target : target.parent()
        if(target.length<=0){ return }
        let pk = target.attr("pk")
        swal({
            title: "Anda sangat yakin?",
            text: text,
            icon: "warning",
            buttons: ["Batal", "Ya"],
        }).then(name => {
            if (!name) return;
            return $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                data: {
                    _method: "put",
                    id: pk,
                },
                beforeSend: (xhr) => { xhr.setRequestHeader('Authorization', `Bearer ${token}`) },
                success: (res) => {
                    if(res==true){
                        window.localStorage.setItem('status', textSuccess)
                        window.location.href = redirect
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
