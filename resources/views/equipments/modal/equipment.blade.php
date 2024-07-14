<!-- Modal -->
{{-- <div class="modal fade" id="equipmentModal" tabindex="-1" aria-labelledby="equipmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Equipment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="equipmentForm">
                    @csrf
                    <div class="form-group">
                        <label for="equipment_name" class="col-form-label">Equipment:</label>
                        <input type="text" class="form-control" name="name" id="equipment_name">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Example select</label>
                        <select class="form-control" name="type" id="equipment_type">
                            <option value="Monitor">Monitor</option>
                            <option value="Keyboard">Keyboard</option>
                            <option value="Mouse">Mouse</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="equipment_price" class="col-form-label">Price:</label>
                        <input type="number" name="price" value="0" min="0" class="form-control" id="equipment_price">
                    </div>

                    <input type="hidden" name="hd_code" id="hd_code">
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_save">Save</button>
            </div>
        </div>
    </div>
</div> --}}

<x-modal :id="$idModal" :title="$idModal" :footer="$btn">
    <form id="equipmentForm">
        @csrf
        <div class="form-group">
            <label for="equipment_name" class="col-form-label">Equipment:</label>
            <input type="text" class="form-control" name="name" id="equipment_name">
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Example select</label>
            <select class="form-control" name="type" id="equipment_type">
                <option value="Monitor">Monitor</option>
                <option value="Keyboard">Keyboard</option>
                <option value="Mouse">Mouse</option>
            </select>
        </div>

        <div class="form-group">
            <label for="equipment_price" class="col-form-label">Price:</label>
            <input type="number" name="price" value="0" min="0" class="form-control" id="equipment_price">
        </div>

        <input type="hidden" name="hd_code" id="hd_code">
    </form>
</x-modal>
