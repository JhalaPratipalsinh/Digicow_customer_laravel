$('#farmer-coop-list').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "ajax": {
        type: "POST",
        url: BASE_URL + '/farmer-coop/coop-paginate',
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
            return row.client_mobile;
        },
        targets: 1,
    },
    {
        render: function (data, type, row) {
            return row.location;
        },
        targets: 2,
    },
    {
        render: function (data, type, row) {
            return row.status;
        },
        targets: 3,
    },
    {
        render: function (data, type, row) {

            let action = `
             <a href="`+ BASE_URL + `/farmer-coop/farmar-coop-edit/` + row.id + `" class="btn btn-sm btn-success" title="Edit">
                 <i class="fa fa-edit"></i>
             </a>
             <a href="`+ BASE_URL +`/farmer-coop/farmar-coop-remove/`+ row.id +`" class="btn btn-sm btn-danger" title="Remove" onclick="return confirm('Are you sure?')">
                <i class="fa fa-trash"></i>
            </a>`;
            return action;
        },
        targets: 4,
    }
    ],
});

