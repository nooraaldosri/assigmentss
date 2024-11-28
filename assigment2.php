<!DOCTYPE html>
<html lang="en">
<!-- Define the document type and language as English -->
<head>
    <meta charset="UTF-8">
    <!-- Set character encoding to UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Set the viewport for responsive design -->
    <title>Document</title>
    <!-- Set the title of the web page -->
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <!-- Include Pico.css library for styling -->
</head>
<body>
</body>
</html>
<!-- Create the basic structure of an HTML document -->
<?php
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";
// Define the API URL for fetching the data

// Use cURL for more reliable API requests
$ch = curl_init();
// Initialize a new cURL session
curl_setopt($ch, CURLOPT_URL, $URL);
// Set the cURL option to specify the URL to fetch
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Ensure the response is returned as a string instead of outputting it directly
$response = curl_exec($ch);
// Execute the cURL request and store the response

if ($response === false) {
    die('API request failed: ' . curl_error($ch));
}
// Check if the request failed; if so, output the error and stop execution

curl_close($ch);
// Close the cURL session to free up resources

// Decode JSON response
$data = json_decode($response, true);
// Convert the JSON string into a PHP associative array

// Start HTML table
echo "<h1>student table</h1>";
// Print a heading for the table
echo "<table border='1'>
<tr>
 <th>year</th>
 <th>semester</th>
    <th>College</th>
    <th>Program</th>
    <th>Nationality</th>
    <th>Number of Students</th>
</tr>";
// Begin the table and define the column headers

// Print out the raw data to debug
// Uncomment the next line to see the actual structure
// print_r($data);

if (isset($data['results'])) {
    // Check if the 'results' key exists in the decoded JSON data
    foreach ($data['results'] as $record) {
        // Loop through each record in the 'results' array
        echo "<tr>";
        // Start a new table row
        // Output the 'year' value, or 'N/A' if not set, while escaping HTML
        echo "<td>" . htmlspecialchars($record['year'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['semester'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($record['colleges'] ?? 'N/A') . "</td>";
        // Output the 'colleges' value, or 'N/A' if not set, while escaping HTML
        echo "<td>" . htmlspecialchars($record['the_programs'] ?? 'N/A') . "</td>";
        // Output the 'the_programs' value, or 'N/A' if not set
        echo "<td>" . htmlspecialchars($record['nationality'] ?? 'N/A') . "</td>";
        // Output the 'nationality' value, or 'N/A' if not set
        echo "<td>" . htmlspecialchars($record['number_of_students'] ?? 'N/A') . "</td>";
        // Output the 'number_of_students' value, or 'N/A' if not set
        echo "</tr>";
        // End the table row
    }
} else {
    echo "<tr><td colspan='4'>No data found</td></tr>";
    // If no data is found, display a message in a single row spanning all columns
}

echo "</table>";
// End the table and output it
?>
