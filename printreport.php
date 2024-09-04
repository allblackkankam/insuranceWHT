<?php
    include("models/connection.php");
    include("models/functions.php");
    include("models/auth.php");

    ini_set("pcre.backtrack_limit","500000000");
    set_time_limit(0);
    require_once __DIR__ . '/vendor/autoload.php';
    
    $insurance = mysqli_real_escape_string($conn,test_input($_GET['in']));
    $year = mysqli_real_escape_string($conn,test_input($_GET['yr']));
    $month = mysqli_real_escape_string($conn,test_input($_GET['mo']));

    $monthName=date('F', mktime(0,0,0, $month,10));

    $query = "SELECT * FROM entry WHERE facility_id = '$center' AND insurance_code = '$insurance' AND entry_id = '$year-$month' ORDER BY id asc;";
    $query.= "SELECT insurance_name FROM insurance WHERE facility_id = '$center' AND insurance_code = '$insurance';";
    $query.= "SELECT * FROM administrator WHERE facility_id = '$center';";
   
    mysqli_multi_query($conn,$query);
    $select_query=mysqli_store_result($conn);
    mysqli_next_result($conn);
    $insurance_name=mysqli_store_result($conn);
    mysqli_next_result($conn);
    $facility=mysqli_store_result($conn);

    $row = mysqli_fetch_array($insurance_name);
    $insurance_name = $row["insurance_name"];

    if(mysqli_num_rows($facility)>0){
        $row=mysqli_fetch_assoc($facility);
        $facility_name=$row["facility_name"];		
        $facility_email=$row["email"];
        $facility_contact=$row["facility_contact"];
        $logo=$row["logo"];		
        $facility_address=$row["address"];	
        $facility_location=$row["location"];	
    }

    $type0 = [];
    $type1 = [];

    $fileName=$insurance_name." ".$monthName."[Report]";
    $html='<table class="table table-bordered2">
                <thead>
                    <tr>
                        <td colspan="2"> 
                            <h2>'.$facility_name.'</h2>
                            <p ><span>Address: ' . $facility_address.' , '.$facility_location.'</span> </p>
                            <p> <span>Contact: ' .$facility_contact.'</a> </p>
                            <p><span>Email: ' .$facility_email.'</span> </p>
                        
                        </td>
                        <th colspan="1"><img src="app-assets/images/'.$logo.'" width="80px" style="text-align:right"></th>
                    </tr>
                    <tr>
                        <th><b>Period - '.$monthName.' '.$year.'</b></th>
                        <th class="caps"><b>CLAIM STATEMENT - '.$insurance_name.'</b></th>
                    </tr>
                </thead>
            </table>
            <hr>
            <table class="table table-bordered">
                <tbody>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount Claimed</th>
                            <th>Amount Rejected</th>
                            <th>Withhoading Tax</th>
                            <th>Payments</th>
                            <th>Balance</th>
                        </tr>
                    </thead>';
            if ($select_query) {

                if (mysqli_num_rows($select_query) > 0) {
                    
                    $servicePaid=0;
                    $drugsPaid=0;
                    $taxPaid=0;
                    $amountReceived=0;
                    $serviceAmount=0;
                    $drugAmount=0;
                    $serviceAdj=0;
                    $drugAdj=0;

                    while ($row = mysqli_fetch_array($select_query)) {
                        if ($row['type'] == 0) {
                            $type0[] = $row;
                            $serviceAmount= $row["amount_services"];
                            $drugAmount= $row["amount_drugs"];
                            $serviceAdj= $row["adjustment_services"];
                            $drugAdj= $row["adjustment_drugs"];
                            $date= $row["date"];
                            $new_date=date("Y-m-d",strtotime($date));

                            $total = $serviceAmount+$drugAmount;
                            $totaladj = $serviceAdj+$drugAdj;
                            $chargeable = $serviceAmount+$drugAmount-$serviceAdj-$drugAdj;

                            $service=$serviceAmount-$serviceAdj;
                            $drug = $drugAmount-$drugAdj;

                            $servicePercent = (7.5/100)*$service;
                            $drugPercent = (3/100)*$drug;

                            $WHTtotal = $servicePercent+$drugPercent;

                            $amountReceivable =  $chargeable- $WHTtotal;

                            $html.='<tr>
                                <td><b>'.$new_date.'</b></td>
                                <td><b>Total Claims Processed For '.$monthName.' '.$year.'</b></td>
                                <td>'.$total.'</td>
                                <td>'.$totaladj.'</td>
                                <td>'.$WHTtotal.'</td>
                                <td>-</td>
                                <td>'.$amountReceivable.'</td>
                            </tr>';
                            
                        } else if ($row['type'] == 1) {
                            $type1[] = $row;
                            
                            $date= $row["date"];
                            $new_date=date("Y-m-d",strtotime($date));

                            $servicePaid+= $row["services_paid"];
                            $drugsPaid+= $row["drugs_paid"];
                            $taxPaid+= $row["tax_paid"];

                            $amountReceived =  $servicePaid + $drugsPaid;
                            $balance = $amountReceivable - $amountReceived; 

                            $html.='';

                            
                        }
                    }
                    $payments= $amountReceivable - $amountReceived;
                    $taxpatment = $WHTtotal - $taxPaid;
                    $outstanding = $payments + $taxpatment;

                    $html.='<tr>
                                <td>'.$new_date.'</td>
                                <td>Payment of Outstanding Claims For '.$monthName.' '.$year.'</td>
                                <td>-</td>
                                <td>-</td>
                                <td>'.$taxPaid.'</td>
                                <td>'.$amountReceived.'</td>
                                <td>'.$balance.'</td>
                            </tr>
                    <tr>
                        <td>'.$new_date.'</td>
                        <td>Payment of Outsanding Claims</td>
                        <td></td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>'.$outstanding.'</td>
                    </tr>';
                }
            }
            $html.='</tbody>
                </table>';

    $mpdf = new \Mpdf\Mpdf([
		
        'margin_top'=>5,
		'margin_left'=>5,
		'margin_right'=>5,
		'margin_bottom'=>5,//this is for the main text
		'margin_footer'=>4,//this is for the footer
		'format' => 'A4',
		'setAutoBottomMargin' => 'stretch',
		'autoMarginPadding' => 1,
		'defaultfooterfontsize'=>1,
		'default_font_size'=>12,
		'tempDir' => __DIR__ . '/mpdftemp'

        
    ]);

	// var_dump($html);
    // echo $html;
	// $content=$html;
	//$mpdf->debug = true;
	$stylesheet = file_get_contents('app-assets/css/print-style.css');
	$mpdf->SetProtection(array('copy','print'));
    $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML(trim($html),\Mpdf\HTMLParserMode::HTML_BODY);
    $mpdf->Output( $fileName.".pdf","I");


?>