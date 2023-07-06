$('#delete-list').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "ajax": {
        type: "POST",
        url: BASE_URL + '/cow/deleted-paginate',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    },
    columnDefs: [{
        render: function (data, type, row) {
            return row.title;
        },
        targets: 0,
    },
    {
        render: function (data, type, row) {

            return row.breed ? row.breed.name : '';
        },
        targets: 1,
    },
    {
        render: function (data, type, row) {
            return row.group ? row.group.name : '';

        },
        targets: 2,
    },
    {
        render: function (data, type, row) {
            return row.date_of_birth;
        },
        targets: 3,
    },
    {
        render: function (data, type, row) {
            var str = row.date_of_birth;
            var arr = str.split('/');

            var sdate = arr[2]+"-"+arr[1]+"-"+arr[0];

            var dateObject = new Date(row.date_of_birth);
            //console.log(dateObject);

            //$date = explode("/",$row['date_of_birth']);
            return '';
        },
        targets: 4,
    },
    {
        render: function (data, type, row) {
            return row.calving_lactation;
        },
        targets: 5,
    },
    {
        render: function (data, type, row) {

            if (row.status == "active") {
                var status = "Live";
            }
            else if(row.status == "sold"){
                var status = "Sold";
            }
            else if(row.status == "dead"){
                var status = "Dead";
            }
            else if(row.status == "delete"){
                var status = "Deleted";
            }
            return status ? status : '' ;
        },
        targets: 6,
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

            <a href="`+ BASE_URL + `/farmer/farmer-remove/` + row.farmer_vet_id + `" class="btn btn-sm btn-danger" title="Remove" onclick="return confirm('Are you sure?')">
                <i class="fa fa-trash"></i>
            </a>
            `;
            return action;
        },
        targets: 7,
    }
    ],
});
