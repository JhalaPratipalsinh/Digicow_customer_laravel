$('#sold-list').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "ajax": {
        type: "POST",
        url: BASE_URL + '/cow/sold-paginate',
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

            return row.buyer_name;
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
            return row.sales_date;
        },
        targets: 3,
    },



    {
        render: function (data, type, row) {

            //     <a href="`+ BASE_URL + `/farmer/view-farmer/` + row.farmer_vet_id + `" target="_blank" class="btn btn-sm btn-primary" title="View Details">
            //     <i class="fa fa-eye"></i>
            // </a>
            // <a href="`+ BASE_URL + `/farmer/edit/` + row.farmer_vet_id + `" class="btn btn-sm btn-success" title="Edit">
            //     <i class="fa fa-edit"></i>
            // </a>
            var action = `

            <a href="`+ BASE_URL + `/cow/sold-remove/` + row.id + `" class="btn btn-sm btn-danger" title="Remove" onclick="return confirm('Are you sure?')">
                <i class="fa fa-trash"></i>
            </a>
            `;
            return action;
        },
        targets: 4,
    }
    ],
});
