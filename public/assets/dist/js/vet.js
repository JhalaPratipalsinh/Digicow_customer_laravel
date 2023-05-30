$('#vet-list').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "ajax": {
        type: "POST",
        url: BASE_URL + '/vet/paginate',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    },
    columnDefs: [{
        render: function (data, type, row) {
            return row.vet_fname + ' ' + row.vet_sname + ' '+ row.vet_lname;
        },
        targets: 0,
    },
    {
        render: function (data, type, row) {
            return row.vet_phone;
        },
        targets: 1,
    },
    {
        render: function (data, type, row) {
            return row.county + '-' + row.subcounty + '-'+ row.ward;
        },
        targets: 2,
    },
    {
        render: function (data, type, row) {
            return row.vet_qualification;
        },
        targets: 3,
    },
    {
        render: function (data, type, row) {
            return row.vet_kvb;
        },
        targets: 4,
    },
    {
        render: function (data, type, row) {
            return row.vet_password;
        },
        targets: 5,
    },
    {
        render: function (data, type, row) {
            return '';
        },
        targets: 6,
    },
    {
        render: function (data, type, row) {
            // let cheeck_isactive = (row.status == 0) ? 'active' : '';
            // var action =
            //     `<button type="button" class="btn btn-sm student_active btn-toggle ` +cheeck_isactive + `"
            //         data-id="` + row.vet_id +`"
            //         data-toggle="button" aria-pressed="true" autocomplete="off"  value="`+row.status+`"
            //         onclick="vetActiveInactive(this, '`+row.vet_id + `')">
            //         <div class="handle"></div>
            //     </button>`;
            var action = ``;
            if (row.available == 0) {
                var action = `<span class="btn btn-sm btn-success">Active</span>`;
            } else {
                var action = `<span class="btn btn-sm btn-danger">Not Active</span>`;
            }



            return action;
        },
        targets: 7,
    },
    {
        render: function (data, type, row) {
            var statusbtn = ``;
            if (row.status == 0) {
                var statusbtn = `<a href="`+ BASE_URL +`/vet/active-inacetive/`+ row.vet_id +`/1" class="btn btn-sm btn-warning">Deactive</a>`;
            } else {
                var statusbtn = `<a href="`+ BASE_URL +`/vet/active-inacetive/`+ row.vet_id +`/0" class="btn btn-sm btn-success">Active</a>`;
            }

            var action = `<a href="`+ BASE_URL +`/vet/edit/`+ row.vet_id +`" class="btn btn-sm btn-primary" title="Edit">
                <i class="fa fa-edit"></i>
            </a><a href="`+ BASE_URL +`/vet/vetremove/`+ row.vet_id +`" class="btn btn-sm btn-danger" title="Remove" onclick="return confirm('Are you sure?')">
                <i class="fa fa-trash"></i>
            </a>&nbsp` +statusbtn+`` ;
            return action;
        },
        targets: 8,
    }
    ],
});
