$('#salary-list').DataTable({

    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "ajax": {
        type: "POST",
        url: BASE_URL + '/salary/salary-paginate',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    },
    columnDefs: [{
        render: function (data, type, row) {
            return row.name;
        },
        targets: 0,
    },
    {
        render: function (data, type, row) {

            return row.staff_mobile_number;
        },
        targets: 1,
    },
    {
        render: function (data, type, row) {
            return row.amount;

        },
        targets: 2,
    },
    {
        render: function (data, type, row) {
            let dateString = moment(row.date).format("MMM DD, YYYY");

            return dateString;

        },
        targets: 3,
    },
    {
        render: function (data, type, row) {
            var action = `
            <a href="`+ BASE_URL + `/salary/salary-remove/` + row.id + `" class="btn btn-sm btn-danger" title="Remove" onclick="return confirm('Are you sure?')">
                <i class="fa fa-trash"></i>
            </a>
            `;
            return action;
        },
        targets: 4,
    }
    ],
});
