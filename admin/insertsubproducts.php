<?php
// Include database connection
include_once '../dbconnection.php';

// Check if the form was submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $product_id = htmlspecialchars($_POST['id']);

    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $capacity = htmlspecialchars($_POST['capacity']);
    $model = htmlspecialchars($_POST['model']);
    $motor_capacity = htmlspecialchars($_POST['motor_capacity']);
    $heater_capacity = htmlspecialchars($_POST['heater_capacity']);
    $shredder_capacity = htmlspecialchars($_POST['shredder_capacity']);
    $power_requirement_per_day = htmlspecialchars($_POST['power_requirement_per_day']);
    $dimensions = htmlspecialchars($_POST['dimensions']);
    $blower_capacity = htmlspecialchars($_POST['blower_capacity']);
    $heating_system = htmlspecialchars($_POST['heating_system']);
    $required_voltage_supply = htmlspecialchars($_POST['required_voltage_supply']);
    $electrical_panel_system = htmlspecialchars($_POST['electrical_panel_system']);
    $display = htmlspecialchars($_POST['display']);
    $carbon_filter = htmlspecialchars($_POST['carbon_filter']);
    $safety_feature = htmlspecialchars($_POST['safety_feature']);
    $sensor = htmlspecialchars($_POST['sensor']);
    $vfd_system = htmlspecialchars($_POST['vfd_system']);
    $machine_paint = htmlspecialchars($_POST['machine_paint']);
    $oil_tank_capacity = htmlspecialchars($_POST['oil_tank_capacity']);
    $weight_of_machine = htmlspecialchars($_POST['weight_of_machine']);
    $price = htmlspecialchars($_POST['price']);
    
    $mainproduct = $_POST['mainproduct'];

    // File upload handling
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "image/" . $filename; // Adjust the folder path as needed

    // Move uploaded file to specified folder
    if (move_uploaded_file($tempname, $folder)) {
        // Construct the SQL query (without prepared statement)
        $sql = "INSERT INTO `subproducts` (`name`, `product_id`,`image`, `description`, `capacity`, `model`, `motor_capacity`, `heater_capacity`, `shredder_capacity`, `power_reqirement`, `diamension`, `blower_capacity`, `heating_system`, `required_voltage`, `electrical_panel`, `display`, `carbon_filter`, `safty_feature`, `sensor`, `vfd_system`, `machine_paint`, `oil_tank_capacity`, `weight_of_machine`, `price`,`mainproduct`) 
                VALUES ('$name', '$product_id', '$filename', '$description', '$capacity', '$model', '$motor_capacity', '$heater_capacity', '$shredder_capacity', '$power_requirement_per_day', '$dimensions', '$blower_capacity', '$heating_system', '$required_voltage_supply', '$electrical_panel_system', '$display', '$carbon_filter', '$safety_feature', '$sensor', '$vfd_system', '$machine_paint', '$oil_tank_capacity', '$weight_of_machine', '$price', '$mainproduct')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>
                    alert('Subproduct added successfully!');
                    window.location.replace('subproducts.php');
                  </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Form submission method not valid.";
}
?>
