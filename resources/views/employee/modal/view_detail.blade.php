<!-- Modal -->
<div class="modal fade" id="orderViewModal" tabindex="-1" aria-labelledby="orderViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Employee View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Other</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_order">
                        <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle text-center">
                            <td>1</td>
                            <td>Item 1</td>
                            <td>Click to expand</td>
                            <td>Click to expand</td>
                        </tr>
                        <tr class="collapse-row">
                            <td colspan="4" class="hiddenRow" style="padding: 0;">
                                <div class="collapse" id="demo1">
                                    <div class="p-1">
                                        จอ Dell ราคา 1000 บาท
                                    </div>
                                    <div class="p-1">
                                        จอ Dell ราคา 1000 บาท
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
