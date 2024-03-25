<!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/scripts/configs/vertical-menu-light.min.js"></script>
    <script src="app-assets/js/core/app-menu.min.js"></script>
    <script src="app-assets/js/core/app.min.js"></script>
    <script src="app-assets/js/core/script.js"></script>
    <script src="app-assets/js/scripts/components.min.js"></script>
    <script src="app-assets/js/scripts/footer.min.js"></script>
    <script src="app-assets/js/scripts/customizer.min.js"></script>
    <script src="app-assets/js/scripts/sweetalert2.all.min.js"></script>
    <script src="app-assets/js/dropzone/dropzone.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/datatables/datatable.min.js"></script>
    <!-- END: Page JS-->

    <script>
    function triggerClick(){
        document.querySelector('.profileDisplay').click();
    }
        function displayImage(e){
            if(e.files[0]){
                var reader = new FileReader()
                    reader.onload = function(e){
                        document.querySelector('.profileImage').setAttribute('src',e.target.result);
                    }
                reader.readAsDataURL(e.files[0]);
            }
        };

      function triggerClicke(){
        document.querySelector('.eprofileDisplay').click();}
              function displayImagee(e){
              if(e.files[0]){
                  var reader = new FileReader()
                      reader.onload = function(e){
                          document.querySelector('.eprofileImage').setAttribute('src',e.target.result);}
                  reader.readAsDataURL(e.files[0]);}
          };
    
        $(document).ready(function(){
            $("body").on("click",".editclose",function(e){

            e.preventDefault();
            window.top.location =window.top.location;
            
            });
        });

        $(document).ready(function(){
        $("body").on("click",".view_alert",function(){
          var carid = $(this).attr('id');

          // AJAX request
          $.ajax({
          url: '../ajax-call/salert-view.php',
          type: 'post',
          data: {carid: carid},
          success: function(response){ 
            // Add response in Modal body
            $('.valert').html(response);

            // Display Modal
            $("#valert").modal("show");
          }
          });
          
        });
    });

    $(".toggle-password").click(function() {

        $(this).toggleClass(" bx bx-show bx bx-hide");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        }
    });

          

    </script>

    <!-- Edit Cars Modal -->
    <div class="modal fade text-left" id="valert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">More Infomation on Alert</h3>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body valert">
                
            </div>
            <div class="modal-footer">
                <button  data-dismiss="modal" aria-label="Close" class="btn btn-light-primary">Close</button>
            </div>
            </div>
        </div>
    </div>
        <!-- END: Footer-->