$('#dead-calf-list').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "ajax": {
        type: "POST",
        url: BASE_URL + '/calfs/dead-paginate',
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

            return row.cause_of_death;
        },
        targets: 1,
    },
    {
        render: function (data, type, row) {
            return row.death_date;

        },
        targets: 2,
    },
    {
        render: function (data, type, row) {
            return row.carcass_amount;
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

            <a href="`+ BASE_URL + `/calfs/dead-remove/` + row.id + `" class="btn btn-sm btn-danger" title="Remove" onclick="return confirm('Are you sure?')">
                <i class="fa fa-trash"></i>
            </a>
            `;
            return action;
        },
        targets: 4,
    }
    ],
});
