<!-- The Modal -->
<div class="modal" id="registerSale">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Register Sale</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form method="post" action="actions.php">
              <div class="form-group">
                <label for="itemid">Item id</label>
                <input type="number" class="form-control" id="itemid" name="itemid" required>
              </div>

              <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-success" name="registerSale">Register Sale</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
