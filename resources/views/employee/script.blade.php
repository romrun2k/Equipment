<script>
    let tbl_employee
    $(document).ready(function() {
        tbl_employee = $('#tbl_employee').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ordering: false,
            ajax: {
                url: '/employee/show',
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
                    data: 'email',
                    name: 'email',
                    class: 'text-center'
                },
                {
                    data: 'total_price',
                    name: 'total_price',
                    class: 'text-right'
                },
                {
                    class: 'text-center',
                    render: function(data, type, row) {
                        html = `
                            <button type="button" class="btn btn-info" onclick="viewMode('${row.code}')" ><i class="bi bi-eye"></i> View</button>
                        `
                        return html
                    }
                },
            ]
        })
    });

    let viewMode = (code) => {
        $('#tbody_order').empty()
        $.ajax({
            type: "get",
            url: "{{ route('employee.view_detail') }}",
            data: {
                code: code
            },
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    let data = response.data
                    let html = ''

                    if (data.length > 0) {
                        for (let index = 0; index < data.length; index++) {
                            const element = data[index]

                            html += `
                            <tr data-toggle="collapse" data-target="#demo${index}" class="accordion-toggle text-center">
                                <td>${index + 1}</td>
                                <td>${element.transaction_date}</td>
                                <td>${element.total_price}</td>
                                <td>${element.other ?? '-'}</td>
                                <td><button class="btn btn-primary"><i class="bi bi-search"></i> Detail</button></td>
                            </tr>
                            `;

                            if (element.get_items.length > 0) {
                                html += `
                                    <tr class="collapse-row">
                                        <td colspan="5" class="hiddenRow" style="padding: 0;">
                                            <div class="collapse" id="demo${index}">
                                        `;
                                            for (let i = 0; i < element.get_items.length; i++) {

                                                let item = element.get_items[i].get_equipment;
                                                let price = formatPrice(element.get_items[i].price)

                                                html += `
                                                <div class="p-1">
                                                    &nbsp- ${ item.name } ${ price } บาท
                                                </div>
                                                `;
                                            }
                                            html += `
                                            </div>
                                        </td>
                                    </tr>
                                `;
                            }

                        }

                        $('#tbody_order').html(html)
                    }
                    $('#orderViewModal').modal('show')
                } else {
                    alert_swal('error', 'เกิดข้อผิดพลาด')
                }
            }
        });
    }
</script>
