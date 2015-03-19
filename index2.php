eqwewe
w
e
w
e
we
wwqwe
qwe
w
e
w
<html>
<head>
    <title>Trulia API / PHP Sample Code</title>
    <style>
        body, table { font-family: Tahoma, Arial, Verdana, Sans-Serif; font-size: 9pt }
        .center {text-align: center }
    </style>
</head>
<body>
<?php


// Prgoram:  TruliaStats - getCityStats REST Web Service Demo
// Platform: PHP4/PHP5
// Author:   Robbie Paplin
// Email:    robbiep (at) caffeinatedsoftware (dot) com

error_reporting(E_ALL);

function marketwatch($city, $state, $months)
{
    // Setup query string parameters for TruliaStats - getCityStats API 
    $apikey = 'pzh836qsrydyk2n9d7nz2e2h';
    $today = date('Y-m-d');
    $monthsago = date('Y-m-d', mktime(0,0,0,date("m")-$months,date("d"),date("Y")));
    $request = 'http://api.trulia.com/webservices.php?library=TruliaStats';
    $request .= '&function=getCityStats&city='.urlencode ($city);
    $request .= '&state='.$state.'&startDate='.$monthsago.'&endDate='.$today;
    $request .= '&apikey='.$apikey;
    
    // Make the request
    $response = file_get_contents($request);

    // Retrieve HTTP status code
    list($version,$status_code,$msg) = explode(' ',$http_response_header[0], 3);

    // Check the HTTP Status code
    if($status_code != 200) 
    {
        die('Your call to Trulia Web Services failed: HTTP status of:' . $status_code);
    }

    // Create a new DOM object
    $dom = new DOMDocument('1.0', 'UTF-8');

    // Load the XML into the DOM
    if ($dom->loadXML($response) === false) 
    {
        die('XML Parsing failed');
    }

    // Get the first searchResultsURL XML node
    $searchResultsURL = $dom->getElementsByTagName('searchResultsURL')->item(0);


    // Write out our table header w/ the City / State the data is for
    echo '<table style="border: solid 1px silver" width="300" scellspacing=0>';
    echo '<tr><td align=center colspan=3><b>Market Activity for ';
    echo '<a href="'.$searchResultsURL->nodeValue.'">'.$city.', '.$state.'</a>';
    echo '</b></td></tr>';
    echo '<tr><td class="center">Week Ending<br>Date';
    echo '</td><td class="center">Number Of<br>Properties';
    echo '</td><td class="center">Median<br>Listing Price';
    echo '</td></td>';

    // Get the first listingStat XML node
    $listingStats = $dom->getElementsByTagName('listingStats')->item(0);
    $listingStat = $listingStats->firstChild;

    // Write out our table rows w/ data
    $i = 0;
    while($listingStat) 
    {
        $i++;
        $weekEndingDate =  $listingStat->getElementsByTagName('weekEndingDate')->item(0);
        $subcategory = $listingStat->getElementsByTagName('subcategory')->item(0);
        $medianListingPrice = $subcategory->getElementsByTagName('medianListingPrice')->item(0);
        $numberOfProperties =  $subcategory->getElementsByTagName('numberOfProperties')->item(0);
        if (($i % 2) == 1) 
        {
            echo '<tr bgcolor=coffco><td class="center">';
        }
        else
        {
            echo '<tr><td class="center">';
        }

        print_r($weekEndingDate->nodeValue);
        echo '</td><td class="center">';
        print_r(number_format($numberOfProperties->nodeValue));
        echo '</td><td class="center">$';
        print_r(number_format($medianListingPrice->nodeValue));
        echo '</td></tr>';

        $listingStat = $listingStat->nextSibling;
    }

    // Finish off our table w/ Trulia attribution
    echo '</table><br>';
    echo '<a href="http://www.trulia.com" target="_top" title="Trulia Real Estate Search">';
    echo '<img src= "http://images.trulia.com/images/logos/trulia_logo_70x42.jpg" alt="Search Real Estate and Homes for Sale" border="0" />';
    echo '</a>';
    echo '<img src="http://www.caffeinatedsoftware.com/images/Caffeinated-Software.png" height="45" Width="69">';
}


?>
<?php
marketwatch('San Francisco', 'CA', 1);
?>
</body>
</html>
