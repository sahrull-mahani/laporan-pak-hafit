$('form').on('submit', function(e) {
    e.preventDefault()
    e.stopPropagation()
    const forms = $('.needs-validation')
    Array.prototype.filter.call(forms, function (form) {
        if (form.checkValidity() === false) {}
        form.classList.add('was-validated')
    })
    $.post({
        url: location.origin + '/simpan',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res) {
            console.log(res)
        },
        error: function(er) {
            const error = er.responseJSON
            console.log(er)
        }
    })
})