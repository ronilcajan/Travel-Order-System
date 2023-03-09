<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Create Position</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= site_url('position/save_position') ?>" >
                    <div class="form-group">
                        <label>Position</label>
                        <input type="text" class="form-control" placeholder="Enter Position" name="position" required>
                    </div>
                    <div class="form-group">
                        <label >Order</label>
                        <input type="number" class="form-control" placeholder="Enter Order" min="1" step="1" name="order" required>
                        <small class="form-text text-muted">Example: Captain is for 1, Councilor 1 is for 2 and so on.</small>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Edit Position</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= site_url('position/update_position') ?>" >
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" class="form-control" id="position" placeholder="Position" name="position" required>
                    </div>
                    <div class="form-group">
                        <label for="order">Order</label>
                        <input type="number" class="form-control" id="order" placeholder="Order" min="1" step="1" name="order" required>
                        <small class="form-text text-muted">Example: Captain is for 1, Councilor 1 is for 2 and so on.</small>
                    </div>
                
            </div>
            <div class="modal-footer">
                <input type="hidden" id="pos_id" name="id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>