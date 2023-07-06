$('#calf-delete-list').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "ajax": {
        type: "POST",
        url: BASE_URL + '/calfs/deleted-paginate',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    },
    columnDefs: [{
        render: function (data, type, row) {
            return row.calf_name;
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
            return row.sex;

        },
        targets: 2,
    },
    {
        render: function (data, type, row) {
            return row.d_o_b;
        },
        targets: 3,
    },
    {
        render: function (data, type, row) {
            // var str = row.date_of_birth;
            // var arr = str.split('/');

            // var sdate = arr[2]+"-"+arr[1]+"-"+arr[0];

            // var dateObject = new Date(row.date_of_birth);
            //console.log(dateObject);

            //$date = explode("/",$row['date_of_birth']);
            return '';
        },
        targets: 4,
    },
    {
        render: function (data, type, row) {
            return row.calf_weight;
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
    }
    ],
});
