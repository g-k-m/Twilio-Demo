/* Setup csrf token else 419 unknown status */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    document.getElementById("container__call__main__submit").onclick = function () {
        var number = document.getElementById("container__call__main__number").value;
        var message = document.getElementById("container__call__main__message").value;

        $.post("/sendmessage", { 'number': number, 'message': message })
            .fail(function (err) {
                console.log('Could not send message');
                console.log(err);
            });
    };
});