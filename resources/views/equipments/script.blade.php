<script>
    //  ใส่ lang alaer
    //  ทำ function valid

    let equipmentsTable
    let mode

    $(document).ready(function() {
        equipmentsTable = $('#equipmentsTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ordering: false,
            ajax: {
                url: '/quipments',
            },
            pageLength: 50,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center'
                },
                {
                    data: 'name',
                    name: 'name',
                    class: 'text-center'
                },
                {
                    data: 'type',
                    name: 'type',
                    class: 'text-center'
                },
                {
                    data: 'price',
                    name: 'price',
                    class: 'text-right'
                },
                {
                    class: 'text-center',
                    render: function(data, type, row) {
                        let html = `
                            <button type="button" class="btn btn-info" onclick="edit('${row.code}')"><i class="bi bi-pencil"></i> Edit</button>
                            <button type="button" class="btn btn-danger" onclick="destroy('${row.code}')"><i class="bi bi-trash"></i> Delete</button>
                        `
                        return html
                    }
                },
            ]
        })

        $('#btnAddModal').click(function () {
            mode = 'save'
            $('#equipmentForm')[0].reset();
            // $('#equipmentModal').modal('show')
        })
    });

    $('#btn_save').click(function(e) {
        e.preventDefault();
        let price = $('#equipment_price').val()
        let name = $('#equipment_name').val()

        if (name == '' || name === undefined) {
            alert_swal('error', 'กรุณาใส่ชื่อสินค้า');
            return false;
        }

        if (price == '' || price === undefined) {
            alert_swal('error', 'กรุณาใส่ข้อมูลราคา');
            return false;
        }

        let formData = $('#equipmentForm').serialize();

        if (mode == 'save') {
            store(formData)
        } else {
            update(formData)
        }
    });

    let store = (formData) => {
        axios.post('/quipments', formData)
            .then(response => {
                if (response.data) {
                    console.log(response);
                    alert_swal('success', "{{ __('status.success') }}")
                    $('#equipmentForm')[0].reset();
                    $('#equipmentModal').modal('hide')
                    equipmentsTable.ajax.reload()
                }
            })
            .catch(error => {
                alert_swal('error', "{{ __('status.error') }}");
        });
    }

    let update = (formData) => {
        let hd_code = $('#hd_code').val()

        axios.put('/quipments/' + hd_code, formData)
            .then(response => {
                if (response.data) {
                    alert_swal('success', "{{ __('status.success') }}")
                    $('#equipmentForm')[0].reset();
                    $('#equipmentModal').modal('hide')
                    equipmentsTable.ajax.reload()
                }
            })
            .catch(error => {
                alert_swal('error', "{{ __('status.error') }}");
        });

    }

    let edit = (code) => {
        mode = 'edit'
        $.ajax({
            type: "get",
            url: "/quipments/" + code + "/edit",
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    let data = response.data
                    $('#hd_code').val(data.code)
                    $('#equipment_price').val(data.price)
                    $('#equipment_name').val(data.name)
                    $('#equipment_type').val(data.type).trigger('change')
                    $('#equipmentModal').modal('show')
                } else {
                    alert_swal('error', "{{ __('status.error') }}")
                }
            }
        });
    }

    let destroy = (code) => {
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {

                axios.delete('/quipments/' + code)
                    .then(response => {
                        if (response.status) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });

                            equipmentsTable.ajax.reload()
                        }
                    })
                    .catch(error => {
                        alert_swal('error', "{{ __('status.error') }}");
                });
            }
        });
    }
</script>
