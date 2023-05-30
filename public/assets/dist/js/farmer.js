$('#farmer-list').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "ajax": {
        type: "POST",
        url: BASE_URL + '/farmer/paginate',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    },
    columnDefs: [{
        render: function (data, type, row) {
            return row.farmer_name;
        },
        targets: 0,
    },
    {
        render: function (data, type, row) {
            return row.mobile_number;
        },
        targets: 1,
    },
    {
        render: function (data, type, row) {
           var vet =  row.vet ? row.vet.vet_fname : '';
            return vet;
        },
        targets: 2,
    },
    {
        render: function (data, type, row) {
            return '';
        },
        targets: 3,
    },
    {
        render: function (data, type, row) {
            return row.county;
        },
        targets: 4,
    },
    {
        render: function (data, type, row) {
            return row.subcounty;
        },
        targets: 5,
    },
    {
        render: function (data, type, row) {
            return row.ward;
        },
        targets: 6,
    },
    {
        render: function (data, type, row) {
            return row.cooperative_name;
        },
        targets: 7,
    },
    {
        render: function (data, type, row) {
            return row.group_name;
        },
        targets: 8,
    },
    {
        render: function (data, type, row) {


            var action = `
            <a href="`+ BASE_URL +`/farmer/view-farmer/`+ row.farmer_vet_id +`" target="_blank" class="btn btn-sm btn-primary" title="View Details">
                <i class="fa fa-eye"></i>
            </a>
            <a href="`+ BASE_URL +`/farmer/edit/`+ row.farmer_vet_id +`" class="btn btn-sm btn-success" title="Edit">
                <i class="fa fa-edit"></i>
            </a>
            <a href="`+ BASE_URL +`/farmer/farmer-remove/`+ row.farmer_vet_id +`" class="btn btn-sm btn-danger" title="Remove" onclick="return confirm('Are you sure?')">
                <i class="fa fa-trash"></i>
            </a>
            `;
            return action;
        },
        targets: 9,
    }
    ],
});
