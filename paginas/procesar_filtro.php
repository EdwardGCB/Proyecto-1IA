<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filtro = $_POST['filtro'];

    // Perform your query based on the selected filter
    // Example: Fetching data from a database
    $resultado = ""; // Initialize the result variable

    // Dummy data for demonstration (replace with your actual query and data handling)
    if ($filtro == "1") {
        $resultado = "Result for Option 1";
    } elseif ($filtro == "2") {
        $resultado = "Result for Option 2";
    } elseif ($filtro == "3") {
        $resultado = "Result for Option 3";
    }

    echo $resultado;
}
?>
