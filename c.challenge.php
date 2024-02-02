<?php

/**
 * 3) Write a method that triggers a request to http://date.jsontest.com/, parses the json 
 *    response and prints out the current date in a readable format as follows: Monday 14th 
 *    of August, 2023 - 06:47 PM
 */
function printCurrentDate()
{
    // Make the HTTP request
    $jsonResponse = file_get_contents('http://date.jsontest.com/');

    if ($jsonResponse === false) {
        echo "Failed to retrieve date information.";
        return;
    }

    // Decode the JSON response
    $data = json_decode($jsonResponse, true);

    if ($data === null) {
        echo "Failed to parse JSON response.";
        return;
    }

    // Extract relevant date and time components
    $weekday = date('l', strtotime($data['date']));
    $day = date('jS', strtotime($data['date']));
    $month = date('F', strtotime($data['date']));
    $year = date('Y', strtotime($data['date']));
    $time = date('h:i A', strtotime($data['date'] . ' ' . $data['time']));

    // Print the formatted date
    echo "$weekday $day of $month, $year - $time";
}


printCurrentDate();
