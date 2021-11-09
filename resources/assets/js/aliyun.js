$(function() {
    if (Cookies.get('modalTicket') == undefined) {
        Swal.fire({
            html: '<a href="https://www.aliyun.li/mfbb" target="_blank"><img src="../assets/images/958462eb98b9391b02331599509b30b3.png"></a>',
            title: false,
            showCancelButton: false,
            showConfirmButton: true,
            confirmButtonText: '关闭',
            // buttonsStyling: false
        }).then(function() {
            Cookies.set("modalTicket", 'yes', { expires: 1 });
        });
    } else {
        Cookies.set("modalTicket", 'yes', { expires: 1 });
    }
});