
$('#feed-list').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "ajax": {
        type: "POST",
        url: BASE_URL + '/feeding/feed-paginate',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    },
    columnDefs: [{
        render: function (data, type, row) {
            return row.feed;
        },
        targets: 0,
    },
    {
        render: function (data, type, row) {
            return row.category;
        },
        targets: 1,
    },
    {
        render: function (data, type, row) {
            return row.quantity;
        },
        targets: 2,
    },
    {
        render: function (data, type, row) {
            return row.total;
        },
        targets: 3,
    },
    {
        render: function (data, type, row) {

            let dateString_ = moment(row.date_selected).format("DD-MM-YYYY");

            return dateString_;
        },
        targets: 4,
    }
    ],
});

