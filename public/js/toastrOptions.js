toastr.options.closeButton = true
toastr.options.closeHtml = '<button><i class="fa-solid fa-xmark"></i></button>'
toastr.options.progressBar = true
toastr.options.timeOut = 5000; // How long the toast will display without user interaction
toastr.options.extendedTimeOut = 10000; // How long the toast will display after a user hovers over it

function toastrSuccess(item){
    if(window.localStorage.getItem(item)!=""){
        toastr.success(window.localStorage.getItem(item), 'SUCCESS')
        window.localStorage.setItem(item, "")
    }
}
