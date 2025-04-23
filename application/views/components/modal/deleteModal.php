<div class="modal fade" id="staticBackdropDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Remove Employee</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
      <form method="post" action="<?php echo base_url('index.php/user/delete_user')?>" id="deleteForm">
        <p>Are you sure you want to delete this employee ?. This action cannot be undone. Otherwise you will have to add this employee again.
        </p>

        <input name="usef" hidden id="usef" type="text" class="form-control" placeholder="User ID" aria-label="usef">

      </div>
      <div class="modal-footer">
       
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keep</button>
              <button type="submit" class="btn btn-danger">Remove</button>
     
      </div>
      </form>
    </div>
  </div>
</div>

</div>
