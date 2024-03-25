<h4 class="card-title">Affilliate info</h4>
  <div class="card">
    <div class="col-md-12">
      <div class="card-content">
        <div class="card-body">
          <form action="" enctype="multipart/form-data" id="form_aff" method="post">
            <div id="msg_aff"></div>
            <div class="row">
              <div class="col-md-4">
                  <fieldset class="form-group">
                  <label>Name <span class="text-danger" id="aff_nameErr"></span></label>
                      <input type="text" class="form-control" name="aff_name" >
                  </fieldset>
              </div>
              <div class="col-md-4">
                <fieldset class="form-group">
                    <label>Phone Number <span class="text-danger" id="aff_numErr"></span></label>
                    <input type="text" class="form-control" name="aff_num" >
                </fieldset>
              </div>
              <div class="col-md-4">
                <fieldset class="form-group">
                    <label>Email <span class="text-danger" id="aff_mailErr"></span></label>
                    <input type="email" class="form-control" name="aff_mail" >
                </fieldset>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <fieldset class="form-group">
                    <label>Position <span  class="text-danger" id="aff_posErr"></span></label>
                    <input type="text" class="form-control" name="aff_pos" >
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset class="form-group">
                <label>Location<span class="text-danger" id="aff_locErr"></span></label>
                    <input type="text" class="form-control" name="aff_loc" >
                </fieldset>
              </div>
            </div>
            <button class="btn btn-primary" id="create_aff" type="submit">Save</button>
          </form>
          <br>
          <br>
          <h4 class="card-title">Affiliates Records</h4>
          <hr>
          <div class="table-responsive">
          <table class="table zero-configuration table table-striped">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>Phone Number</th>
                      <th>Email</th>
                      <th>Postion</th>
                      <th>Location</th>
                      <th>Date Added</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  <?php Affs(); ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>


<?php 

  if(isset($_GET['delete'])){
        $id =base64_decode( $_GET["delete"]);
        
        $query = "DELETE FROM aff WHERE aff_id = $id ";

        $result = mysqli_query($conn,$query);

        echo "<script>location='vrs'</script>";
    }

  ?>