<script>
    let tbl_odrer
    let monitor = @json($monitor);

    // setup option monitor
    let keys = Object.keys(monitor);
    // Reverse the array of keys
    keys.reverse();
    // Initialize the HTML string for options
    let option_monitor = '';
    // Loop through the reversed array of keys
    keys.forEach(key => {
        option_monitor += `<option value="${key}">${monitor[key]}</option>`;
    });

    $(document).ready(function() {
        tbl_odrer = $('#tbl_odrer').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ordering: false,
            ajax: {
                url: '/orderList/show',
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
                    data: 'total_price',
                    name: 'total_price',
                    class: 'text-right'
                },
                {
                    data: 'transaction_date',
                    name: 'transaction_date',
                    class: 'text-center'
                },
                {
                    class: 'text-center',
                    render: function(data, type, row) {
                        let html = `
                            <button type="button" class="btn btn-info" onclick="viewMode('${row.code}')" ><i class="bi bi-eye"></i> View</button>
                        `
                        return html
                    }
                },
            ]
        })
    });

    let addModal = () => {
        $('#orderForm')[0].reset();
        $('#orderModal').modal('show')
    }

    let viewMode = (code) => {
        $('#tbody_view').empty()
        $('#text_foot').empty()

        $.ajax({
            type: "get",
            url: "{{ route('orderList.view_detail') }}",
            data: {
                code: code
            },
            dataType: "json",
            success: function(response) {

                if (response.status) {

                    let data = response.data
                    let html = ''

                    if (data.length > 0) {
                        for (let i = 0; i < data.length; i++) {
                            html += `
                                <tr>
                                    <td>${ i + 1 }</td>
                                    <td>${ data[i].get_equipment.name }</td>
                                    <td>${ data[i].price }</td>
                                </tr>
                            `
                        }

                        $('#tbody_view').html(html)

                    }
                    if (response.other != null) {
                        $('#text_foot').html(response.other)
                    }


                    $('#orderViewModal').modal('show')
                } else {
                    alert_swal('error', 'เกิดข้อผิดพลาด')
                }
            }
        });
    }

    let id = 2
    let addMonitor = () => {
        let html = `
            <div class="input-group my-3" id="group_${id}">
                <select class="form-control" id="equipment_monitor_${id}" name="equipment_monitor[]">
                    ${option_monitor}
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-danger" onclick="deleteMonitor(${id})" type="button">Delete</button>
                </div>
            </div>
        `
        id++
        $('#div_monitor').append(html)
    }

    let deleteMonitor = (id) => {
        $(`#group_${id}`).remove()
    }

    let save = () => {
        let formData = $('#orderForm').serialize()

        $.ajax({
            type: "post",
            url: "/orderList",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    alert_swal('success', 'สำเร็จ')
                    $('#orderForm')[0].reset();
                    $('#orderModal').modal('hide')
                    tbl_odrer.ajax.reload()

                } else {

                    if (response.data === 'have_item') {
                        alert_swal('error', response.message);
                    } else {
                        alert_swal('error', 'เกิดข้อผิดพลาด');
                    }

                }
            }
        });

    }
</script>
