<script>
    let tbl_equipment
    let mode

    $(document).ready(function() {
        tbl_equipment = $('#tbl_equipment').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ordering: false,
            ajax: {
                url: '/master_quipment/show',
                data: function(d) {
                    // d.date_number = $('#date_number').val();
                },
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
                            <button type="button" class="btn btn-info" onclick="editData('${row.code}')"><i class="bi bi-pencil"></i> Edit</button>
                            <button type="button" class="btn btn-danger" onclick="f_delete('${row.code}')"><i class="bi bi-trash"></i> Delete</button>
                        `
                        return html
                    }
                },
            ]
        })
    });

    let addModal = () => {
        mode = 'save'
        $('#equipmentForm')[0].reset();
        $('#equipmentModal').modal('show')
    }

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
            save(formData)
        } else {
            update(formData)
        }
    });

    let save = (formData) => {
        $.ajax({
            type: "post",
            url: "/master_quipment",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    alert_swal('success', 'สำเร็จ')
                    $('#equipmentForm')[0].reset();
                    $('#equipmentModal').modal('hide')
                    tbl_equipment.ajax.reload()

                } else {
                    alert_swal('error', 'เกิดข้อผิดพลาด');
                }
            }
        });
    }

    let update = (formData) => {
        let hd_code = $('#hd_code').val()
        $.ajax({
            type: "put",
            url: "/master_quipment/" + hd_code,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    alert_swal('success', 'สำเร็จ')
                    $('#equipmentForm')[0].reset();
                    $('#equipmentModal').modal('hide')
                    tbl_equipment.ajax.reload()
                } else {
                    alert_swal('error', 'เกิดข้อผิดพลาด');
                }
            }
        });
    }

    let editData = (code) => {
        mode = 'edit'
        $.ajax({
            type: "get",
            url: "{{ route('master_quipment.editData') }}",
            data: {
                code: code
            },
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
                    alert_swal('error', 'เกิดข้อผิดพลาด')
                }
            }
        });
    }

    let f_delete = (code) => {

        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "put",
                    url: "{{ route('master_quipment.f_delete') }}",
                    data: {
                        code: code
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            tbl_equipment.ajax.reload()
                        } else {
                            alert_swal('error', 'เกิดข้อผิดพลาด');
                        }
                    }
                });


                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            }
        });





    }
</script>
