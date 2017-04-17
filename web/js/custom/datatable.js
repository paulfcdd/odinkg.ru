$('.smartTable').DataTable({
    pageLength: 10,
    responsive: true,
    dom: '<"html5buttons"B>lTfgitp',
    oLanguage: {
        "sSearch": "Фильтр:",
        "sLengthMenu": 'Показывать _MENU_ записей',
        "sInfo": "Показаны от _START_ до _END_ записей из _TOTAL_",
        "sZeroRecords": "Нет записей для отображения",
        oPaginate: {
            "sNext": "Следующая",
            "sPrevious": "Предыдущая"
        }
    },
    buttons: [
        {extend: 'copy'},
        {extend: 'csv'},
        {extend: 'excel', title: 'Объекты Красная Горка'},
        {extend: 'pdf', title: 'Объекты Красная Горка'},

        {
            extend: 'print',
            customize: function (win) {
                $(win.document.body).addClass('white-bg');
                $(win.document.body).css('font-size', '10px');

                $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
            }
        }
    ]

});