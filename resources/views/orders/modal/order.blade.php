<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="orderForm">
                    @csrf
                    <div class="text-right">
                        <button class="btn btn-primary mb-2" type="button" onclick="addMonitor()"> <i class="bi bi-plus-circle"></i> Add Monitor</button>
                    </div>

                    <div id="div_monitor">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Monitor</label>
                            <select class="form-control" name="equipment_monitor[]" id="equipment_monitor_1">
                                @foreach ($monitors as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Keyboard</label>
                        <select class="form-control" name="equipment_keyboard" id="equipment_keyboard">
                            @foreach ($keyboards as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Mouse</label>
                        <select class="form-control" name="equipment_mouse" id="equipment_mouse">
                            @foreach ($mouses as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">อื่นๆ นอกเหนือในรายการ</label>
                        <textarea class="form-control" id="other" name="other" rows="3"></textarea>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>
            </div>
        </div>
    </div>
</div>
