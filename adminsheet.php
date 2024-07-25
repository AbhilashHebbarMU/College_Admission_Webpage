<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universitydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get filter parameter
$departmentFilter = isset($_GET['department']) ? $_GET['department'] : '';

// Prepare SQL query with filter
$sql = "SELECT id, user_id, name, email, phone, high_school, gpa, sat_score, course, essay FROM applications";
if (!empty($departmentFilter)) {
    $sql .= " WHERE course LIKE ?";
}

// Prepare and execute the query
$stmt = $conn->prepare($sql);
if (!empty($departmentFilter)) {
    $param = "%" . $departmentFilter . "%";
    $stmt->bind_param("s", $param);
}
$stmt->execute();
$result = $stmt->get_result();

// Check for SQL errors
if (!$result) {
    die("Query failed: " . $stmt->error);
}

// Generate table rows from the fetched data
$tableRows = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tableRows .= "<tr>";
        $tableRows .= "<td>" . htmlspecialchars($row["id"]) . "</td>";
        $tableRows .= "<td>" . htmlspecialchars($row["user_id"]) . "</td>";
        $tableRows .= "<td>" . htmlspecialchars($row["name"]) . "</td>";
        $tableRows .= "<td>" . htmlspecialchars($row["email"]) . "</td>";
        $tableRows .= "<td>" . htmlspecialchars($row["phone"]) . "</td>";
        $tableRows .= "<td>" . htmlspecialchars($row["high_school"]) . "</td>";
        $tableRows .= "<td>" . htmlspecialchars($row["gpa"]) . "</td>";
        $tableRows .= "<td>" . htmlspecialchars($row["sat_score"]) . "</td>";
        $tableRows .= "<td>" . htmlspecialchars($row["course"]) . "</td>";
        $tableRows .= "<td>" . htmlspecialchars($row["essay"]) . "</td>";
        $tableRows .= "</tr>";
    }
} else {
    $tableRows = "<tr><td colspan='10'>No data available</td></tr>";
}

// Close connection
$stmt->close();
$conn->close();

// Return table rows
echo $tableRows;
?>