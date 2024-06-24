<script>
    let validateField = (fieldId, errorId) => {
        let fieldValue = $(fieldId).val();
        if (fieldValue == null || fieldValue == '') {
            $(errorId).show();
            setTimeout(function() {
                $(errorId).hide();
            }, 3000);
            return false;
            return false;
        }
        return true;
    }

    let register = () => {
        if (!validateField('#email', '#error-email')) return false;
        if (!validateField('#name', '#error-name')) return false;
        if (!validateField('#password', '#error-password')) return false;
        if (!validateField('#confirm_password', '#error-confirm-password')) return false;

        if ($('#password').val() !== $('#confirm_password').val()) {
            $('#error-notmatch-password').show();
            setTimeout(function() {
                $('#error-notmatch-password').hide();
            }, 3000);
            return false;
        }

        let formData = $('#form_register').serialize();
        $.ajax({
            type: "post",
            url: "{{ route('register') }}",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    window.location.href = '/orderList'
                } else {
                   $('#display-error').empty()
                   $('#display-error').html(response.errors.email[0]).fadeIn(200).delay(2000).fadeOut(200);
                }
            }
        });
    }
</script>
