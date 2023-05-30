
dataTable();
$("#filter_date").change(function(){
    $("#breeding-list").DataTable().destroy();
    dataTable(true);
});
function dataTable(filters = null)
{
    let end_point = '';
    end_point =BASE_URL + '/breeding/paginate';
    if(filters)
    {
        let filter_type = $('#filter_type').val();
        let filter_date = $('#filter_date').val();
        console.log(filter_date);
        end_point =BASE_URL + '/breeding/paginate?filter_type='+filter_type+'&filter_date='+filter_date;
    }
    $('#breeding-list').DataTable({
        dom: 'Bfrtip',
        "pageLength": 50,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        buttons: [
            'csv', //'copy',  'excel', 'pdf', 'print'
        ],
        "ajax": {
            type: "POST",
            url: end_point,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columnDefs: [{
            render: function (data, type, row) {
                return row.farmer_name+ ' - '+row.mobile;
            },
            targets: 0,
        },
        {
            render: function (data, type, row) {
                return row.cow_id+ ' - '+row.cow_name;
            },
            targets: 1,
        },
        {
            render: function (data, type, row) {
                return row.bull_code+ ' - '+row.bull_name;
            },
            targets: 2,
        },
        {
            render: function (data, type, row) {
                return row.vet_id+ ' - '+row.vet_name;
            },
            targets: 3,
        },
        {
            render: function (data, type, row) {
                return row.drying_date;
            },
            targets: 4,
        },
        {
            render: function (data, type, row) {
                return row.expected_date_of_birth;
            },
            targets: 5,
        },
        {
            render: function (data, type, row) {
                return row.expected_repeat_date;
            },
            targets: 6,
        },
        {
            render: function (data, type, row) {
                return row.date_dt;
            },
            targets: 7,
        },
        {
            render: function (data, type, row) {
                return row.first_heat;
            },
            targets: 8,
        },
        {
            render: function (data, type, row) {
                return row.first_heat;
            },
            targets: 9,
        },
        {
            render: function (data, type, row) {
                return row.firebase_id;
            },
            targets: 10,
        },
        ],
    });
}
