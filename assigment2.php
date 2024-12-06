<?php
// Fetching data from the API
$url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";
$response = file_get_contents($url);

if ($response === false) {
    die('Error fetching data. The API request failed.');
}
// Decode the JSON response
$result = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error decoding JSON: ' . json_last_error_msg());
}
// Check if 'results' key exists in the decoded data
if (!isset($result['results']) || !is_array($result['results'])) {
    die('Error: No valid data found in the response.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Enrollment Data</title>
    <!-- Link to Pico CSS -->
    <link rel="stylesheet" href="https://unpkg.com/pico.css">
    <style>
 /* Additional styling for table responsiveness and overflow handling */
 table {
            width: 100%;
            border-collapse: collapse; /* For removing double borders */
        }
        th, td {
            padding: 12px 15px;
            text-align: left; /* Align text to the left for better readability */
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .table-wrapper {
            max-width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-top: 20px;
        }
        /* Adding alternate row colors for readability */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<main class="container">
    <h2>Students Enrollment Data</h2>

    <!-- Table wrapper for better overflow handling -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>The Programs</th>
                    <th>Nationality</th>
                    <th>Colleges</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result['results'] as $record): ?>
                <tr>
                    <td><?php echo htmlspecialchars($record['year']); ?></td>
                    <td><?php echo htmlspecialchars($record['semester']); ?></td>
                    <td><?php echo htmlspecialchars($record['the_programs']); ?></td>
                    <td><?php echo htmlspecialchars($record['nationality']); ?></td>
                    <td><?php echo htmlspecialchars($record['colleges']); ?></td>
                    <td><?php echo htmlspecialchars($record['number_of_students']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>