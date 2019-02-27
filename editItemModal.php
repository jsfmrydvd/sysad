
<!-- The Modal -->
<div class="modal" id="editItemModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form method="post" action="actions.php">
              <div class="form-group">
                <label for="itemid">Item id</label>
                <input type="number" class="form-control" id="item_id" name="itemid" value="" readonly >
              </div>
              <div class="form-group">
                <label for="pname">Product name<?php $pname?></label>
                <input type="text" class="form-control" id="pname" name="pname" required>
              </div>
              <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price"  step="0.01" required>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-danger" name="editItem">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<script>
function getId(id, pname) {
    document.getElementById('item_id').value = id;
}
</script>
