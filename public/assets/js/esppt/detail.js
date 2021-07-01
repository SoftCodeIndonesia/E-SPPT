$(document).ready(function () {
    var id = $("#sppt_id").val();
    var totalnjop = 0;
    var totalPajak = 0;

    $.ajax({
        type: "POST",
        url: base_url + 'esppt/getTotalNjop',
        data: {
            sppt_id: id
        },
        dataType: "json",
        success: function (response) {
            totalnjop = response.total_njop;
            $('#total_njop').html(`${formatRupiah(response.total_njop)}`);
        }
    });


    $.ajax({
        type: "POST",
        url: base_url + 'esppt/getById',
        data: {
            e_sppt: id
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            $("#jatuh_tempo").html(response.due_date);
            $("#metode").html(response.payment);
            $('#pemilik').html(response.owner);
            var address = `${response.address} RT ${response.rt}/${response.rw}` 
            $('#alamat').html(address)
            $('#nop').html(`NOP - ${response.nop}`);
            $('#njkp').html(`${formatRupiah(response.njkp)}`);
            $('#pbb').html(`${response.pbb_terhutang} %`);

            var total = parseInt(totalnjop) + parseInt(response.njkp);
            var total = (response.pbb_terhutang / 100) * total;
            // var totalPajak = Math.round(total);
            totalPajak = total;
            $("#total").html(formatRupiah(Math.round(totalPajak)));
           
        }
    });

   

    function formatRupiah(angka){
        console.log(angka);
        var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }
dataTablesCreated();

function dataTablesCreated() {
    return $('#DataTables_Table_0').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        "destroy": true,
        "ordering": false,
        "order": [],
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false
        }],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "type": "POST",
            "url": base_url + 'esppt/getObjectTaxForDetail',
            "data": {
                sppt_id: $('input[name="sppt_id"]').val()
            },
        },
    });
}
});