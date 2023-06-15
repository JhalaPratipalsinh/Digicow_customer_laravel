$('#arifical-list').DataTable({
    scrollY: "300px",
    scrollX: true,
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "ajax": {
        type: "POST",
        url: BASE_URL + '/artificial-insemination/artificial-paginate',
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

            return row.bull_name;
        },
        targets: 1,
    },
    {
        render: function (data, type, row) {
            return row.bull_code;

        },
        targets: 2,
    },
    {
        render: function (data, type, row) {
            return row.cost;

        },
        targets: 3,
    },
    {
        render: function (data, type, row) {
            return row.date_dt;

        },
        targets: 4,
    },
    {
        render: function (data, type, row) {
            let dateString = moment(row.pregnancy_date).format("MMM DD, YYYY");

            return dateString;

        },
        targets: 5,
    },

    {
        render: function (data, type, row) {


            return `<td>-</td>`;

        },
        targets: 6,
    },

    {
        render: function (data, type, row) {
            let repat = moment(row.expected_repeat_date).format("MMM DD, YYYY");

            return repat;

        },
        targets: 7,
    },

    {
        render: function (data, type, row) {
            let dary = moment(row.drying_date).format("MMM DD, YYYY");

            return dary;

        },
        targets: 8,
    },

    {
        render: function (data, type, row) {
            let strimin = moment(row.strimingup_date).format("MMM DD, YYYY");

            return strimin;

        },
        targets: 9,
    },

    {
        render: function (data, type, row) {
            let date_of_birt = moment(row.expected_date_of_birth).format("MMM DD, YYYY");

            return date_of_birt;

        },
        targets: 10,
    },
    ],
});
