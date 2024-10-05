<link rel="shortcut icon" type="image/x-icon" href="app-assets/images/favicon.png">
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

    if($month==0){
        $monthName='Year';
    }else{
        $monthName=date('F', mktime(0,0,0, $month,10));
    }   
  
    if($insurance==0){
        $insuranceFilter=" ";
    }else{
        $insuranceFilter="AND insurance_code = '$insurance' ";
    }
    
    if($month==0){
        $yearFilter="AND SUBSTRING_INDEX(entry_id, '-', 1) = '$year'";
    }else{
        $yearFilter="AND entry_id='$year-$month'";
    }

    $query = "SELECT * FROM entry WHERE facility_id = '$center' $yearFilter $insuranceFilter ORDER BY insurance_code,entry_id,id;";
    $query.= "SELECT * FROM insurance WHERE facility_id = '$center';";
    $query.= "SELECT insurance_name FROM insurance WHERE facility_id = '$center' AND insurance_code = '$insurance';";
    $query.= "SELECT * FROM administrator WHERE facility_id = '$center';";
   
    // echo $query;
    mysqli_multi_query($conn,$query);
    $select_query=mysqli_store_result($conn);
    mysqli_next_result($conn);
    $insurance_result=mysqli_store_result($conn);
    mysqli_next_result($conn);
    $insurance_selected=mysqli_store_result($conn);
    mysqli_next_result($conn);
    $facility=mysqli_store_result($conn);

    if(mysqli_num_rows($facility)>0){
        $row=mysqli_fetch_assoc($facility);
        $facility_name=$row["facility_name"];		
        $facility_email=$row["email"];
        $facility_contact=$row["facility_contact"];
        $logo=$row["logo"];		
        $facility_address=$row["address"];	
        $facility_location=$row["location"];	
    }

    if($insurance==0){
        $name_insurance = "ALL INSURANCE";
    }else{
        $row = mysqli_fetch_array($insurance_selected);
        $name_insurance = $row["insurance_name"];
    }

    if($insurance_result)
    {
        if(mysqli_num_rows($insurance_result)>0)
        {
            while($row=mysqli_fetch_array($insurance_result))
            {
                $insurance_code=$row["insurance_code"];
                $insurance_name=$row["insurance_name"];
                $name[$insurance_code]=$insurance_name;
              
                
           }
        }
    }

    $fileName=$name_insurance." ".$monthName."-".$year."[Report]";
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
            <th class="caps"><b>CLAIM STATEMENT - '.$name_insurance.'-'.$monthName.' '.$year.'</b></th>
        </tr>
    </thead>
</table>
<hr>';     

    // Initialize an array to store rows grouped by insurance_code and entry_id
$groupedEntries = [];

// Fetch all rows and group them by insurance_code and entry_id
if ($select_query->num_rows > 0) {
    while($row = $select_query->fetch_assoc()) {
        $insurance_code = $row['insurance_code'];
        $entry_id = $row['entry_id'];

        if (!isset($groupedEntries[$insurance_code])) {
            $groupedEntries[$insurance_code] = [];
        }

        if (!isset($groupedEntries[$insurance_code][$entry_id])) {
            $groupedEntries[$insurance_code][$entry_id] = [];
        }

        // Add row to the respective insurance_code and entry_id group
        $groupedEntries[$insurance_code][$entry_id][] = $row;
    }

}

// Display each insurance_code with its respective rows, grouped by entry_id
foreach ($groupedEntries as $insurance_code => $entriesByEntryId) {
    // Display the insurance_code as a heading
    $html.= '<h5 style="margin-bottom:5px;margin-top:5px;text-transform:uppercase;">Insurance : '.$name[$insurance_code].'</h5>';
    
    // Output table header
    $html.= '<table class="table table-bordered mb-0">
            <thead class="thead-light">
                <tr>
                    <th >Date</th>
                    <th >Description</th>
                    <th >Amount Claimed</th>
                    <th >Amount Rejected</th>
                    <th >WHT Tax</th>
                    <th >WHT Tax Payed</th>
                    <th >Payments</th>
                    <th >Balance</th>
                </tr>
            </thead>';

    // Iterate through each entry_id under the insurance_code
    foreach ($entriesByEntryId as $entry_id => $rows) {
        // Initialize an array to handle combined type=1 entries
        $combinedEntries = [];
        $balanceForEntryId = null;
        $totalTax=null;

        // Loop through the rows under this entry_id
        foreach ($rows as $row) {
            // Calculate the balance for each row
            $serviceAmount= $row["amount_services"];
            $drugAmount= $row["amount_drugs"];
            $serviceAdj= $row["adjustment_services"];
            $drugAdj= $row["adjustment_drugs"];
            $date= $row["date"];
            $new_date=date("d-m-y",strtotime($date));
            $entryIn =$row["entry_id"];
            $monthIn = getMonth($entryIn);

            $total = $serviceAmount+$drugAmount;
            $totaladj = $serviceAdj+$drugAdj;
            $chargeable = $serviceAmount+$drugAmount-$serviceAdj-$drugAdj;

            $service=$serviceAmount-$serviceAdj;
            $drug = $drugAmount-$drugAdj;

            $servicePercent = (7.5/100)*$service;
            $drugPercent = (3/100)*$drug;

            $WHTtotal = $servicePercent+$drugPercent;

            $amountReceivable =  $chargeable- $WHTtotal;

            // If type is 0, display the row normally
            if ($row['type'] == 0) {
                $balanceForEntryId = $amountReceivable;
                $totalTax = $WHTtotal;
                $html.= '<tr>
                        <td ><b>'.$new_date.'</b></td>
                        <td ><b>Total claims processed for '.$monthIn." ".$year.'</b></td>
                        <td ><b>'.number_format($total,2).'</b></td>
                        <td ><b>'.number_format($totaladj,2).'</b></td>
                        <td ><b>'.number_format($WHTtotal,2).'</b></td>
                        <td ><b>0</b></td>
                        <td ><b>0</b></td>
                        <td ><b>'.number_format($amountReceivable,2).'</b></td>
                    </tr>';
            }
            // If type is 1, aggregate data for rows with the same entry_id
            else if ($row['type'] == 1) {
                $key = $row['entry_id'];

                $entryIn =$row["entry_id"];
                $monthIn = getMonth($entryIn);

                if (!isset($combinedEntries[$key])) {
                    $combinedEntries[$key] = [
                        'entry_id' => $row['entry_id'],
                        'facility_id' => $row['facility_id'],
                        'user_id' => $row['user_id'],
                        'date' => $row['date'],
                        'combined_paid' => 0,
                        'tax_paid' => 0
                    ];
                }

                // Add services_paid, drugs_paid, and tax_paid for each matching entry
                $combinedEntries[$key]['combined_paid'] += $row['services_paid'] + $row['drugs_paid'] ;

                // Add the tax_paid to keep it separate
                $combinedEntries[$key]['tax_paid'] += $row['tax_paid'];

              
                // $balance = $amountReceivable ; 
            }
        }

        // Output the combined rows for type = 1 under this entry_id
        foreach ($combinedEntries as $combined) {
            $balanceForType1 = $balanceForEntryId - $combined['combined_paid'];
            $totalOutstanding= $balanceForType1 +  ($totalTax -$combined['tax_paid']);
            $html.= '
            
            <tr>
                <td >'.$new_date.'</td>
                <td >Payment of outstanding claims for '.$monthIn." ".$year.'</td>
                <td >0</td>
                <td >0</td>
                <td >0</td>
                <td >'.number_format($combined['tax_paid'],2).'</td>
                <td >'.number_format($combined['combined_paid'],2).'</td>
                <td >'.number_format($balanceForType1,2).'</td>
            </tr>
            <tr>
                <td >'.$new_date.'</td>
                <td >Outstanding claims for '.$monthIn.' '.$year.'</td>
                <td >0</td>
                <td >0</td>
                <td ></td>
                <td >0</td>
                <td >0</td>
                <td >'.number_format($totalOutstanding,2).'</td>
            </tr>';
        }
    }

    $html.= '</table>';
}
    $html.='        </div>
                </div>
            </div>
        </div>
    </section>';

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