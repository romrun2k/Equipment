<script>
    function login() {
        let emailValue = $('#email').val()
        let passwordValue = $('#password').val()


        if (emailValue === '') {
            $('#error-email').show();
            return false;
        }

        if (passwordValue === '') {
            $('#error-password').show();
            return false;
        }

        let formData = $('#form_login').serialize();
        $.ajax({
            type: "post",
            url: "{{ route('check_login') }}",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.data == 'Invalid login credentials') {
                    Swal.fire({
                        title: 'Error!',
                        text: 'ไม่พบผู้ใช้ในระบบ',
                        icon: 'error',
                        confirmButtonText: 'ปิด'
                    })
                } else if (response.data == 'login success') {
                    if(response.role == 'user') {
                        window.location.href = "/orderList"
                    } else {
                        window.location.href = "/employee"
                    }
                }
            },
        });

    }
</script>
