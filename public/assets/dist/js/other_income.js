$('#otherIncome-list').DataTable({

    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "ajax": {
        type: "POST",
        url: BASE_URL + '/other_incomes/income-paginate',
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
            return row.amount;

        },
        targets: 1,
    },
    {
        render: function (data, type, row) {
            let dateString = moment(row.date_selected).format("MMM DD, YYYY");

            return dateString;

        },
        targets: 2,
    },
    {
        render: function (data, type, row) {
            var action = `
            <a href="`+ BASE_URL + `/other_incomes/income-remove/` + row.id + `" class="btn btn-sm btn-danger" title="Remove" onclick="return confirm('Are you sure?')">
                <i class="fa fa-trash"></i>
            </a>
            `;
            return action;
        },
        targets: 3,
    }
    ],
});
