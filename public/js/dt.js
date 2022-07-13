function setDatatable(p={}){
    const
        url = p.url,
        token = p.token,
        table = p.table,
        createdRow = p.createdRow ? p.createdRow : (row, data, dataIndex)=>{},
        columnDefs = p.columnDefs ? p.columnDefs : [],
        columns = p.columns ? p.columns : [
            { data: "no", className: "text-center", sortable: false, },
            { data: "name" },
        ],
        lengthMenu = p.lengthMenu ? p.lengthMenu : [5, 10, 15, 20,],
        drawCallback = p.drawCallback ? p.drawCallback : (s)=>{},
        buttonAddText = p.buttonAddText,
        buttonAddUrl = p.buttonAddUrl,
        order = p.order ? p.order : [[1, 'asc']]

    table.DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: lengthMenu,
        dom: `
            <'row mt-3'
                <'col d-flex align-items-center'B>
                <'col'f>
            >
            <'row'
                <'col'tr>
            >
            <'row'
                <'col-sm-12 col-md-3 d-flex align-items-center justify-center sm:justify-start'l>
                <'col-sm-12 col-md-4 d-flex justify-center align-items-center'i>
                <'col-sm-12 col-md-5 d-flex align-items-center justify-center sm:justify-end'p>
            >`,
        order: order,
        ajax:{
            url: url,
            dataType: "json",
            beforeSend: (xhr) => { xhr.setRequestHeader('Authorization', `Bearer ${token}`) },
            error: (jqXHR, textStatus, errorThrown) => {
                let message = jqXHR.responseJSON && jqXHR.responseJSON.message ? jqXHR.responseJSON.message : errorThrown
                toastr.error(message,textStatus.toUpperCase())
            }
        },
        createdRow: createdRow,
        columns: columns,
        columnDefs: columnDefs,
        drawCallback: (s)=>{
            let table = $(s.nTable)
            table.find("tbody").addClass("table-light")
            table.closest(".dataTables_wrapper").find(".dataTables_filter input").attr("class","border-gray-300 focus:border-emerald-500-important focus:ring focus:ring-emerald-300-important focus:ring-opacity-50 rounded-md shadow-sm")
            drawCallback(s)
        },
        buttons: [
            {
                text: `<i class="fa-solid fa-plus"></i> <span class="sm:inline hidden">${buttonAddText}</span>`,
                attr: { class: 'inline-flex items-center px-2 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 active:bg-emerald-800 focus:outline-none focus:border-emerald-800 focus:ring focus:ring-emerald-100 disabled:opacity-25 transition' },
                action: function ( e, dt, node, config ) {
                    window.location.href = buttonAddUrl
                }
            }
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari",
            emptyTable: "Tidak ada data yang tersedia",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "<br>(tersaring dari _MAX_ total data)",
            lengthMenu: "Menampilkan _MENU_ data",
            loadingRecords: "Sedang memuat data",
            zeroRecords: "Tidak ada data yang ditemukan",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Prev"
            },
        },
    })
}
