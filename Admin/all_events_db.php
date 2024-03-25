<?php



// Fetch events from the database and order them by date in ascending order
$query = "SELECT * FROM events ORDER BY event_date ASC";
$result = mysqli_query($conn, $query);

if ($result) {
    echo '
            <table>
                <thead>
                    <tr>
                        <th>Event ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Date and Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';

    // Loop through the result set and display each event's details
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['event_id'] . '</td>';
        echo '<td>' . $row['event_title'] . '</td>';
        echo '<td>' . $row['event_description'] . '</td>';
        echo '<td>' . $row['event_type'] . '</td>';
        echo '<td>' . $row['event_date'] . '</td>';
        echo '<td>
                <button class="editEvent" onclick="editEvent(' . $row['event_id'] . ')">Edit</button>
                <button class="removeEvent" onclick="removeEvent(' . $row['event_id'] . ')">Remove</button>
                </td>';
            
        echo '</tr>';
    }

    echo '</tbody></table>';

    // Free the result set
    mysqli_free_result($result);
} else {
    // Display an error message if the query fails
    echo "Error executing query: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

   