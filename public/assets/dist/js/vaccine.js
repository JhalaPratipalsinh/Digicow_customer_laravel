$('#vaccine-list').DataTable({

    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "ajax": {
        type: "POST",
        url: BASE_URL + '/health-report/vaccine-paginate',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    },
    columnDefs: [{
        render: function (data, type, row) {
            return row.cow_name;
        },
        targets: 0,
    },
    {
        render: function (data, type, row) {

            return row.diagnosis;
        },
        targets: 1,
    },
    {
        render: function (data, type, row) {
            return row.cost;

        },
        targets: 2,
    },
    {
        render: function (data, type, row) {

            let dateString = moment(row.treatment_date).format("MMM DD, YYYY");

            return dateString;

        },
        targets: 3,
    },


    ],
});
