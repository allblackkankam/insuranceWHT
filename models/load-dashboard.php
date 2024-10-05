

<?php 

include("connection.php");
include("functions.php");
include("auth.php");


if($_SERVER["REQUEST_METHOD"]=="POST"){

   
    $year = mysqli_real_escape_string($conn, test_input($_POST['year']));

// Get the current year and month
$currentYear = date('Y');
$currentMonth = date('n');

// Initialize variables to prevent "undefined variable" notices
$amountReceived = 0;
$taxPaid = 0;

// Query to get entries for the specific year
$query = "SELECT * FROM entry WHERE facility_id = '$center' AND SUBSTRING_INDEX(entry_id, '-', 1) = '$year' ORDER BY id ASC;";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}

// Initialize an array to hold monthly totals
$monthlyTotals = array_fill(1, 12, [
    'totalSubmitted' => 0,
    'totalAdjusted' => 0,
    'amountReceived' => 0,
    'outstandingBalance' => 0,
]);

// Process each row
while ($row = mysqli_fetch_assoc($result)) {
    $entryId = $row["entry_id"];
    $serviceAmount = $row["amount_services"];
    $drugAmount = $row["amount_drugs"];
    $serviceAdj = $row["adjustment_services"];
    $drugAdj = $row["adjustment_drugs"];
    $servicePaid= $row["services_paid"];
    $drugsPaid= $row["drugs_paid"];
    $taxPaid= $row["tax_paid"];

    $total = $serviceAmount + $drugAmount;
    $totalAdj = $serviceAdj + $drugAdj;
    $chargeable = $serviceAmount + $drugAmount - $serviceAdj - $drugAdj;

    $service = $serviceAmount - $serviceAdj;
    $drug = $drugAmount - $drugAdj;

    $servicePercent = (7.5 / 100) * $service;
    $drugPercent = (3 / 100) * $drug;

    $WHTtotal = $servicePercent + $drugPercent;
   
    $amountReceived =  $servicePaid + $drugsPaid;

    $amountReceivable = $chargeable - $WHTtotal;
    
    $outstanding = ($amountReceivable - $amountReceived) + ($WHTtotal - $taxPaid);

    // Extract month from entry_id
    $month = intval(explode('-', $entryId)[1]);

    // Update totals for the specific month
    if (isset($monthlyTotals[$month])) {
        $monthlyTotals[$month]['totalSubmitted'] += $total;
        $monthlyTotals[$month]['totalAdjusted'] += $totalAdj;
        $monthlyTotals[$month]['amountReceived'] += $amountReceived;
        $monthlyTotals[$month]['outstandingBalance'] += $outstanding;
    }
}

// Display results for each month
$months = [
    1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June",
    7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"
];

foreach ($months as $monthNumber => $monthName) {
    // Determine if this month has passed by considering both year and month
    if ($year < $currentYear || ($year == $currentYear && $monthNumber <= $currentMonth)) {
        $isPassed = true;
    } else {
        $isPassed = false;
    }

    $totalSubmitted = isset($monthlyTotals[$monthNumber]['totalSubmitted']) ? $monthlyTotals[$monthNumber]['totalSubmitted'] : 0;
    $totalAdjusted = isset($monthlyTotals[$monthNumber]['totalAdjusted']) ? $monthlyTotals[$monthNumber]['totalAdjusted'] : 0;
    $amountReceived = isset($monthlyTotals[$monthNumber]['amountReceived']) ? $monthlyTotals[$monthNumber]['amountReceived'] : 0;
    $outstandingBalance = isset($monthlyTotals[$monthNumber]['outstandingBalance']) ? $monthlyTotals[$monthNumber]['outstandingBalance'] : 0;

    echo "<div class='col-md-3 col-sm-6 mb-sm-1 report' data-month='$monthNumber'>
            <div class='months " . ($isPassed ? "passed" : "not-passed") . "' id=' " . ($isPassed ? "entry" : "") . "'>
                <p class='font-size-large'>$monthName</p>
                <div class='mt-2'>
                    <p>Total Submitted <span class='float-right font-4'>$totalSubmitted</span></p>
                    <p>Total Adjusted <span class='float-right font-4'>$totalAdjusted</span></p>
                    <p>Payment Received <span class='float-right font-4'>$amountReceived</span></p>
                    <p>Outstanding Balance <span class='float-right font-4'>$outstandingBalance</span></p>
                </div>
            </div>
        </div>";
}


    

}

?>

