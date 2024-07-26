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

// Function to insert values into database
function insertToDatabase($conn, $amount, $keterangan, $tipe_kas, $table) {
    $stmt = $conn->prepare("INSERT INTO $table (jumlah, keterangan, tipe_kas, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iss", $amount, $keterangan, $tipe_kas);
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

    // Insert into database
    include 'config/database.php'; // Ensure this file contains $conn
    insertToDatabase($conn, $osisAmount, 'Inputan Kas oleh OSIS', 'pemasukan', 'kas_osis');
    insertToDatabase($conn, $pramukaAmount, 'Inputan Kas oleh OSIS', 'pemasukan', 'kas_pramuka');
    insertToDatabase($conn, $kkrAmount, 'Inputan Kas oleh OSIS', 'pemasukan', 'kas_kkr');
    insertToDatabase($conn, $pmrAmount, 'Inputan Kas oleh OSIS', 'pemasukan', 'kas_pmr');

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