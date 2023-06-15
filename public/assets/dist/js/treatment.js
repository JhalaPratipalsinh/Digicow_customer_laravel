$('#treatment-list').DataTable({

    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "ajax": {
        type: "POST",
        url: BASE_URL + '/health-report/treatment-paginate',
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

            return row.treatment;
        },
        targets: 1,
    },
    {
        render: function (data, type, row) {
            return row.diagnosis;

        },
        targets: 2,
    },
    {
        render: function (data, type, row) {
            return row.cost;

        },
        targets: 3,
    },
    {
        render: function (data, type, row) {

            let dateString = moment(row.treatment_date).format("MMM DD, YYYY");

            return dateString;

        },
        targets: 4,
    },

    {
        render: function (data, type, row) {
            var action = `
            <a href="`+ BASE_URL + `/health-report/edit-treatment/` + row.id + `" class="btn btn-sm btn-success" title="Edit">
                <i class="fa fa-edit"></i>
            </a>
            <a href="`+ BASE_URL + `/health-report/health-remove/` + row.id + `" class="btn btn-sm btn-danger" title="Remove" onclick="return confirm('Are you sure?')">
                <i class="fa fa-trash"></i>
            </a>
            `;
            return action;
        },
        targets: 5,
    }
    ],
});
