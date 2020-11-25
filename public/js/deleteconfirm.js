$(document).ready(function () {
    $(function () {
        $("#delete_button").click(function () {
            if (confirm("Click OK to continue?")) {
                $('form#delete').submit();
            }
        });
    });
})


