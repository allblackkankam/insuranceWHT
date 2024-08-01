

<?php 

include("connection.php");
include("functions.php");
include("auth.php");


if($_SERVER["REQUEST_METHOD"]=="POST"){

    $insurance = mysqli_real_escape_string($conn,test_input($_POST['insurance']));
    $year = mysqli_real_escape_string($conn,test_input($_POST['year']));
    $month = mysqli_real_escape_string($conn,test_input($_POST['month']));

    $monthName=date('F', mktime(0,0,0, $month,10));

    $query = "SELECT * FROM entry WHERE facility_id = '$center' AND insurance_code = '$insurance' AND entry_id = '$year$month' ORDER BY id asc;";
    $query.= "SELECT insurance_name FROM insurance WHERE facility_id = '$center' AND insurance_code = '$insurance';";
   
    mysqli_multi_query($conn,$query);
    $select_query=mysqli_store_result($conn);
    mysqli_next_result($conn);
    $insurance_name=mysqli_store_result($conn);

    $row = mysqli_fetch_array($insurance_name);
    $insurance_name = $row["insurance_name"];

    $type0 = [];
    $type1 = [];

    if ($select_query) {
        echo'';
        if (mysqli_num_rows($select_query) > 0) {
            echo '
            <section id="table-customer-statistics">
                <div class="row match-height">
                    <!-- table latest custoner start -->
                    <div id="table-latest-customer" class="col-lg-8 col-md-12">
                        <div class="card ">
                <div class="card-header">
                    <h4 class="card-title font-weight-bolder text-uppercase">'.$insurance_name.'-'.$monthName.' '.$year.'</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li class="ml-2"><button class="btn btn-outline-secondary add">Add Payments</button></li>
                        </ul>
                    </div>
                </div>
                <hr class="m-0">
                ';
                    $servicePaid=0;
                    $drugsPaid=0;
                    $taxPaid=0;
                    $amountReceived=0;

                    while ($row = mysqli_fetch_array($select_query)) {
                        if ($row['type'] == 0) {
                            $type0[] = $row;
                            $serviceAmount= $row["amount_services"];
                            $drugAmount= $row["amount_drugs"];
                            $serviceAdj= $row["adjustment_services"];
                            $drugAdj= $row["adjustment_drugs"];

                            $chargerble = $serviceAmount+$drugAmount-$serviceAdj-$drugAdj;

                            $service=$serviceAmount-$serviceAdj;
                            $drug = $drugAmount-$drugAdj;

                            $servicePercent = (7.5/100)*$service;
                            $drugPercent = (3/100)*$drug;

                            $WHTtotal = $servicePercent+$drugPercent;

                            $amountReceivable =  $chargerble- $WHTtotal;
                            
                        } else if ($row['type'] == 1) {
                            $type1[] = $row;
                            
                            $servicePaid+= $row["services_paid"];
                            $drugsPaid+= $row["drugs_paid"];
                            $taxPaid+= $row["tax_paid"];

                            $amountReceived =  $servicePaid + $drugsPaid;

                           
                        }
                    }
                        // Outstanding
                        $payments= $amountReceivable - $amountReceived;
                        $taxpatment = $WHTtotal - $taxPaid;
                        $outstanding = $payments + $taxpatment;

                    echo '<table class="table mb-0 dataTable no-footer table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Services Submitted</th>
                                <th>Drugs Submitted</th>
                                <th>Services Adjustment</th>
                                <th>Drugs Adjustment</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($type0 as $row){
                            echo' <tr data-id="' . $row['id']. '" data-drugamt="'.$row['amount_drugs'].'" data-serviceamt="'.$row['amount_services'].'" data-drugadj="'.$row['adjustment_drugs'].'" data-serviceadj="'.$row['adjustment_services'].'">
                                <td class="">' . $row['amount_services'] . '</td>
                                <td class="">' . $row['amount_drugs'] . '</td>
                                <td class="">' . $row['adjustment_services'] . '</td>
                                <td class="">' . $row['adjustment_drugs'] . '</td>
                                <td>
                                    <div class="dropdown">
                                        <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item edit" href="javascript:void(0)" ><i class="bx bx-edit-alt mr-1"></i> Edit</a>
                                            <a class="dropdown-item delete text-danger" href="javascript:void(0)" data-txt="Delete" data-up="2"><i class="bx bx-trash mr-1 text-danger" data-type="0"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>';
                        }
                    echo'</tbody>
                </table>
                <hr class="m-0">';
                    
                    echo '<table class="table mb-0 dataTable no-footer table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Services Paid</th>
                                <th>Drugs Paid</th>
                                <th>Tax Paid</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($type1 as $row){
                            echo'<tr data-id="' . $row['id']. '" data-drugpaid="'.$row['drugs_paid'].'" data-servicepaid="'.$row['services_paid'].'" data-taxpaid="'.$row['tax_paid'].'">
                                <td class="">' . $row['services_paid'] . '</td>
                                <td class="">' . $row['drugs_paid'] . '</td>
                                <td class="">' . $row['tax_paid'] . '</td>
                               <td>
                                    <div class="dropdown">
                                        <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item editpayment" href="javascript:void(0)" ><i class="bx bx-edit-alt mr-1"></i> Edit</a>
                                            <a class="dropdown-item delete text-danger" href="javascript:void(0)" data-txt="Delete" data-up="2"><i class="bx bx-trash mr-1 text-danger" data-type="1"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>';
                        }
                    echo'</tbody>
                </table>'; // You can handle type 1 cases here if needed
                    
                

        echo '</div>
                </div>
                   
                    <div id="table-statistics-two" class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h5 class="card-title">Statistics</h5>
                                <div class="heading-elements">
                                    <div class="dropdown">
                                        <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item report" href="javascript:void(0)" ><i class="bx bxs-report mr-1"></i> View Report</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0">
                                <tbody>
                                <tr>
                                    <td>
                                    <div class="d-flex align-items-center text-bold-500">Chargerble</div>
                                    </td>
                                    <td class="text-right">'.$chargerble.'</td>
                                </tr>
                                <tr>
                                    <td>
                                    <div class="d-flex align-items-center text-bold-500">WHT Rounded</div>
                                    </td>
                                    <td class="text-right">'.$WHTtotal.'</td>
                                </tr>
                                <tr>
                                    <td>
                                    <div class="d-flex align-items-center text-bold-500">Amount Receivable</div>
                                    </td>
                                    <td class="text-right">'.$amountReceivable.'</td>
                                </tr>
                                 <tr>
                                    <td>
                                    <div class="d-flex align-items-center text-bold-500">Tax Paid</div>
                                    </td>
                                    <td class="text-right">'.$taxPaid.'</td>
                                </tr>
                                <tr>
                                    <td>
                                    <div class="d-flex align-items-center text-bold-500">Payment Received</div>
                                    </td>
                                    <td class="text-right">'.$amountReceived.'</td>
                                </tr>
                                <tr>
                                    <td>
                                    <div class="d-flex align-items-center text-bold-500"><b>Outstanding Balance<b></div>
                                    </td>
                                    <td class="text-right">'.$outstanding.'</td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                            <!-- table end -->
                        </div>
                    </div>
                    <!-- table table statistics two ends -->
                </div>
            </section>';
            
        } else {
            echo '
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title font-weight-bolder text-uppercase">'.$insurance_name.'-'.$monthName.' '.$year.'</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                           
                        </ul>
                    </div>
                </div>
                <hr class="m-0">
            <div class="card-body">
            <form id="add_first_form">
            <div id="msg"></div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Service Amount<span class="text-danger" id="service_amtErr"></span></label>
                        <input type="number" class="form-control isnumeric" name="service_amt" id="service_amt" value="0">
                        <input type="hidden" class="form-control" name="action" id="action" value="0">
                        <input type="hidden" class="form-control" name="type" id="type" value="new">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Drugs Amount<span class="text-danger" id="drugs_amteErr"></span></label>
                        <input type="number" class="form-control isnumeric" name="drugs_amt" id="drugs_amt" value="0">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Services Adjustment<span class="text-danger" id="ervice_adjErr"></span></label>
                        <input type="number" class="form-control isnumeric" name="service_adj" id="service_adj" value="0">
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label>Drugs Adjustment<span class="text-danger" id="drugs_adjErr"></span></label>
                        <input type="number" class="form-control isnumeric" name="drugs_adj" id="drugs_adj" value="0">
                    </div>
                </div>
                
            </div>
            <div  class="text-right">
                <button type="button" class="btn btn-primary" id="add_first">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Save</span>
                </button>
            </div>

            
        </form>'; // This message will show if no rows are found
        }
        echo'</div>
        </div>';
    } else {
        echo 'No data Available'; // This message will show if the query fails
    }



    

}

?>

