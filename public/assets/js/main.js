$('form').on('submit', function (e) {
    e.preventDefault()
    e.stopPropagation()
    const forms = $('.needs-validation')
    Array.prototype.filter.call(forms, function (form) {
        if (form.checkValidity() === false) { }
        form.classList.add('was-validated')
    })
    $.post({
        url: location.origin + '/simpan',
        data: new FormData(this),
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function (res) {
            console.log(res)
        },
        error: function (er) {
            const error = er.responseJSON
            console.log(er)
        }
    })
})

$("#dtBox").DateTimePicker({
    buttonsToDisplay: ['HeaderCloseButton', 'SetButton'],
})