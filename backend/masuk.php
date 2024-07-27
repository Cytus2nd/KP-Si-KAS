<?php 
// Function to round values according to the specified logic
function roundValue($value) {
    $remainder = $value % 100;
    if ($remainder < 50) {
        return $value - $remainder;
    } else {
        return $value + (100 - $remainder);
    }
}

// Function to insert values into the database
function insertToDatabase($conn, $amount, $keterangan, $tipe_kas, $table, $id_user) {
    $stmt = $conn->prepare("INSERT INTO $table (jumlah, keterangan, tipe_kas, id_user, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("issi", $amount, $keterangan, $tipe_kas, $id_user);
    $stmt->execute();
    $stmt->close();
}

// Initialize variables
$osisAmount = $pramukaAmount = $kkrAmount = $pmrAmount = $totalRounded = 0;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $totalAmount = (int)$_POST['totalAmount'];

    // Calculate the amounts
    $osisAmount = roundValue($totalAmount * 0.50);
    $pramukaAmount = roundValue($totalAmount * 0.30);
    $kkrAmount = roundValue($totalAmount * 0.10);
    $pmrAmount = roundValue($totalAmount * 0.10);

    // Calculate the total of the rounded values
    $totalRounded = $osisAmount + $pramukaAmount + $kkrAmount + $pmrAmount;

    // Adjust the last category (PMR) to ensure the total matches the user input
    $difference = $totalAmount - $totalRounded;
    $pmrAmount += $difference; // Apply the difference to PMR amount

    // Recalculate the total after adjustment
    $totalRounded = $osisAmount + $pramukaAmount + $kkrAmount + $pmrAmount;

    // Insert into the database
    include 'config/database.php'; // Ensure this file contains $conn

    // Retrieve the logged-in user's ID from the session
    $id_user = $_SESSION['id_user'];

    // Insert the values into the respective tables
    insertToDatabase($conn, $osisAmount, 'Inputan Kas oleh OSIS', 'pemasukan', 'kas_osis', $id_user);
    insertToDatabase($conn, $pramukaAmount, 'Inputan Kas oleh OSIS', 'pemasukan', 'kas_pramuka', $id_user);
    insertToDatabase($conn, $kkrAmount, 'Inputan Kas oleh OSIS', 'pemasukan', 'kas_kkr', $id_user);
    insertToDatabase($conn, $pmrAmount, 'Inputan Kas oleh OSIS', 'pemasukan', 'kas_pmr', $id_user);

    // Store results in session and redirect
    $_SESSION['result'] = [
        'osis' => $osisAmount,
        'pramuka' => $pramukaAmount,
        'kkr' => $kkrAmount,
        'pmr' => $pmrAmount,
        'total' => $totalRounded
    ];

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Retrieve results from session
$results = isset($_SESSION['result']) ? $_SESSION['result'] : null;

// Clear session messages
unset($_SESSION['result']);
