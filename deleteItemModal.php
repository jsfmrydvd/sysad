<!-- The Modal -->
<div class="modal" id="deleteItemModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete product</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        Are you sure you want to delete?
        <!-- Modal footer -->
        <form method="post" action="actions.php">
            <div class="form-group">
              <label for="itemid">Item id</label>
              <input type="number" class="form-control" id="item_id_delete" name="itemid" value="" readonly >
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" name="deleteItem">Delete</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
