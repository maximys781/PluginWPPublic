$(document).ready(function() {
$('#delete').click(function(e) {
    var id = $(this).closest('tr').find('td:first').text().trim();
    e.preventDefault();
    $(this).closest('tr').remove(); // или $(this).parent().parent

    $.ajax({
        type: "POST",
        url: 'func.php',
        data: {
            id: id
        },
        success: function() {
            alert("Cancelled");
        }
    });
});
});

//не до конца реализовано