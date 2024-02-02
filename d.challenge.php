<?php

/**
 * Write a method that triggers a request to http://echo.jsontest.com/john/yes/tomas/no/belen/yes/peter/no/julie/no/gabriela/no/messi/no, parse the json response.
 * Using that data print two columns of data. The left column should contain the names of the persons that responses 'no',
 * and the right column should contain the names that responded 'yes'
 */
function printResponses()
{
    // Make the HTTP request to http://echo.jsontest.com/
    $jsonResponse = file_get_contents('http://echo.jsontest.com/john/yes/tomas/no/belen/yes/peter/no/julie/no/gabriela/no/messi/no');

    if ($jsonResponse === false) {
        echo "Failed to retrieve response information.";
        return;
    }

    // Decode the JSON response
    $data = json_decode($jsonResponse, true);

    if ($data === null) {
        echo "Failed to parse JSON response.";
        return;
    }

    // Separate names into 'yes' and 'no' arrays
    $yesNames = [];
    $noNames = [];

    foreach ($data as $name => $response) {
        if ($response === 'yes') {
            $yesNames[] = $name;
        } elseif ($response === 'no') {
            $noNames[] = $name;
        }
    }

    // Print two columns of data
    echo "Names that responded 'no':\n";
    foreach ($noNames as $name) {
        echo "- $name\n";
    }

    echo "\nNames that responded 'yes':\n";
    foreach ($yesNames as $name) {
        echo "- $name\n";
    }
}

printResponses();
