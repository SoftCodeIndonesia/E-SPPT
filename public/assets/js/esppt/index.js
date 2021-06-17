var table = dataTablesCreated();




function dataTablesCreated() {
    return $('#DataTables_Table_1').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        "ordering": false,
        "order": [],
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false
        }],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": base_url + 'esppt/getAllSppt',
            "type": "POST"
        },
    });
}