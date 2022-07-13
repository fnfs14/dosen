$(document).ready(function () {
    const isAdmin = $("meta[name='is-admin']").attr("content")
    const bearerDeny = $("meta[name='bearer-deny']").attr("content")
    const bearerApprove = $("meta[name='bearer-approve']").attr("content")
    const user = $("meta[name='promote-user']").attr("content")
    const url = $("meta[name='app-url']").attr("content")

    setStatus({
        table: "#form-data",
        url: `${url}api/promote/deny`,
        token: bearerDeny,
        redirect: `${url}promote/u/${user}`,
        target: `btn-danger`,
        text: "Tolak pengajuan",
        textSuccess: "Pengajuan berhasil ditolak",
    })

    setStatus({
        table: "#form-data",
        url: `${url}api/promote/approve`,
        token: bearerApprove,
        redirect: `${url}promote/u/${user}`,
        target: `btn-success`,
        text: "Setujui pengajuan",
        textSuccess: "Pengajuan berhasil disetujui",
    })
})
