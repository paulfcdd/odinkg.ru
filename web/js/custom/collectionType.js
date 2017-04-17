var collectionHolder;

var addItemBtn = ('<div>' +
'<a href="#" class="add-new-item btn btn-flat btn-block btn-primary square-border"><span class="fa fa-plus"></span>&nbsp;Добавить файл</a>' +
'</div>');

$(document).ready(function () {

    $.each($('.file-collection'), function (key, val) {
        collectionHolder = val;
        $(collectionHolder).append(addItemBtn);
        $(collectionHolder).data('index', $(val).find(':input').length)
    });

    $('.add-new-item').on('click', function (e) {
        e.preventDefault();

        addNewItem($(collectionHolder), $(this))
    })
});

function addNewItem(collectionHolder, newItem) {
    var prototype = collectionHolder.data('prototype'),
        index = collectionHolder.data('index'),
        newFormItem = prototype.replace(/__name__/g, index),
        newFromGroup = $('<div class="form-group"></div>').append(newFormItem);

    collectionHolder.data('index', index + 1);

    // also add a remove button, just for this example
    newFromGroup
        .append(
            '<div style="margin: 10px 0">' +
            '<a class="btn square-border btn-block btn-danger remove-tag" href="#">' +
            '<span class="fa fa-times"></span>&nbsp;Удалить поле' +
            '</a>' +
            '</div>'
        );

    $(newItem).before(newFromGroup);

    $('.remove-tag').click(function (e) {
        e.preventDefault();

        $(this).closest('div .form-group').remove();

        return false;
    });
}