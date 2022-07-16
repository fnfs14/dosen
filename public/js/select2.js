function setSelect2Ajax(p={}){
    const select = p.select
    const url = p.url
    const bearerToken = p.bearerToken
    const placeholder = p.placeholder ? p.placeholder : "Please Select"
    const selected = p.selected ? p.selected : undefined
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

                ___setSelect2Value(select)
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

    setSelect2(select,{
        ajax: ajax,
        placeholder: placeholder,
    })

    ajax.data = { id: selected }
    $.ajax(ajax)
}

function setSelect2(select,p={}){
    params = {
        width: 'resolve',
        allowClear: true,
        dropdownParent: select.parent(),
    }

    if(p.ajax) params.ajax = p.ajax
    if(p.placeholder) params.placeholder = p.placeholder

    select.on("select2:open", (e)=>{
        $(".select2-search__field").addClass("focus:border-emerald-300-important focus:ring focus:ring-emerald-100")
    })

    if(!p.ajax) select.val(select.attr("pk"))

    return select.select2(params)
}

function ___setSelect2Value(select){
    console.log("asdasdasdas")
    var time = 100
    var limit = time*50
    var current = 0
    var SI = setInterval(()=>{
        var pk = select.attr("pk")
        if(pk!=undefined){
            // select.val(pk)
            // select.val(pk).trigger("change")
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
