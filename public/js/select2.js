function setSelect2(p={}){
    const select = p.select
    const url = p.url
    const bearerToken = p.bearerToken
    const processResults = p.processResults ? p.processResults : (item,i)=>{
        return {
            text: item.text,
            id: item.id
        }
    }

    let isFirst = true
    const ajax = {
        url: url,
        data: (params)=>{ return { search: params.term, } },
        beforeSend: (xhr) => { xhr.setRequestHeader('Authorization', `Bearer ${bearerToken}`) },
        processResults: (data)=>{ return { results: $.map(data, processResults) } },
        success: (res) => {
            if(!$.isArray(res)){
                toastr.error("Internal Server Error","ERROR")
            }else{
                if(isFirst==true){
                    select.html("")
                    res.map((v,i)=>{
                        var value = $.type(v)=="string" ? v : v.id
                        var text = $.type(v)=="string" ? v : v.text
                        select.append(`<option value="${value}">${text}</option>`)
                    })
                }

                var time = 100
                var limit = time*50
                var current = 0
                var SI = setInterval(()=>{
                    var pk = select.attr("pk")
                    if(pk!=undefined){
                        select.val(pk).trigger("change.select2")
                        clearInterval(SI)
                        return
                    }
                    if(current>=limit){
                        clearInterval(SI)
                        return
                    }
                    current+=time
                },time)
            }
        },
        error: (jqXHR, textStatus, errorThrown) => {
            if(textStatus.toUpperCase()=="ABORT"){ return }
            let message = jqXHR.responseJSON && jqXHR.responseJSON.message ? jqXHR.responseJSON.message : errorThrown
            toastr.error(message,textStatus.toUpperCase())
        },
        complete: ()=>{
            isFirst = false
        }
    }

    select.select2({
        placeholder: 'Please Select',
        width: 'resolve',
        allowClear: true,
        dropdownParent: select.parent(),
        ajax: ajax
    })

    $.ajax(ajax)
}
