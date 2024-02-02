<?php

/**
 * 2) Write a class "LetterCounter" and implement a static method "CountLettersAsString" 
 *    which receives a string parameter and returns a string that shows how many times each letter shows up in the string by using an asterisk (*).
 *    Example: "Interview" -> "i:**,n:*,t:*,e:**,r:*,v:*,w:*"
 */

class LetterCounter
{
    public static function CountLettersAsString($inputString)
    {
        // Remove non-alphabetic characters and convert to lowercase
        $cleanedString = preg_replace("/[^a-zA-Z]/", "", strtolower($inputString));

        // Initialize an associative array to store letter counts
        $letterCounts = [];

        // Count the occurrences of each letter
        foreach (str_split($cleanedString) as $letter) {
            if (isset($letterCounts[$letter])) {
                $letterCounts[$letter]++;
            } else {
                $letterCounts[$letter] = 1;
            }
        }

        // Build the result string with asterisks
        $resultString = '';
        foreach ($letterCounts as $letter => $count) {
            $resultString .= $letter . ':' . str_repeat('*', $count) . ',';
        }

        // Remove the trailing comma
        $resultString = rtrim($resultString, ',');

        return $resultString;
    }
}

$inputString = "Interview Internet";
$result = LetterCounter::CountLettersAsString($inputString);

echo $result;
