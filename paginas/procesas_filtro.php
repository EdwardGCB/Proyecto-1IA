<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_value = $_POST['dropdownValue'];

    // Now $selected_value contains the selected option from the dropdown
    echo "Selected value: " . htmlspecialchars($selected_value);
}
?>
