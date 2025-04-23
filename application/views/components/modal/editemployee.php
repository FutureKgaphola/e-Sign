<!-- Modal -->
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Employee</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('index.php/user/update_user')?>" id="editForm">
          <label for="basic-url" class="form-label small">Employee Name</label>
          <input  name="userid" id="userid" hidden type="text" class="form-control" placeholder=""
              aria-label="userid" aria-describedby="basic-addon1">
              <input  name="emp_no" id="emp_no" hidden type="text" class="form-control" placeholder=""
              aria-label="userid" aria-describedby="basic-addon1">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                <path fill-rule="evenodd"
                  d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
              </svg>
            </span>
            <input  name="name" id="name" type="text" class="form-control" placeholder="Employee Name"
              aria-label="name" aria-describedby="basic-addon1">
          </div>
          
          <label for="basic-url" class="form-label small">Employee Position</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-steps" viewBox="0 0 16 16">
              <path d="M.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-1 0V.5A.5.5 0 0 1 .5 0M2 1.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm2 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1-.5-.5zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5z"/>
            </svg>
            </span>
            <input id='position' name="position" type="text" class="form-control" placeholder="Employee Position"
              aria-label="position" aria-describedby="basic-addon1">
          </div>
          <label for="empStatus" class="form-label small">Employment Status</label>
          <select id="empStatus" name="empStatus" class="form-select form-select-sm" required aria-label="Employment Type">
            <option value="permanent">Permanent</option>
            <option value="intern">Intern</option>
          </select>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>