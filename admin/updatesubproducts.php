<?php
include_once '../dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $capacity = $_POST['capacity'];
    $model = $_POST['model'];
    $motor_capacity = $_POST['motor_capacity'];
    $heater_capacity = $_POST['heater_capacity'];
    $shredder_capacity = $_POST['shredder_capacity'];
    $power_reqirement = $_POST['power_reqirement']; 
    $diamension = $_POST['diamension']; 
    $blower_capacity = $_POST['blower_capacity'];
    $heating_system = $_POST['heating_system'];
    $required_voltage = $_POST['required_voltage'];
    $electrical_panel = $_POST['electrical_panel'];
    $display = $_POST['display'];
    $carbon_filter = $_POST['carbon_filter'];
    $safty_feature = $_POST['safty_feature']; 
    $sensor = $_POST['sensor'];
    $vfd_system = $_POST['vfd_system'];
    $machine_paint = $_POST['machine_paint'];
    $oil_tank_capacity = $_POST['oil_tank_capacity'];
    $weight_of_machine = $_POST['weight_of_machine'];
    $price = $_POST['price'];

    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "image/" . $filename;

    if (!empty($filename)) {
        // Image is uploaded
        if (move_uploaded_file($tempname, $folder)) {
            // Prepare the SQL statement to update the record including the image
            $sql = "UPDATE `subproducts` SET `name`=?, `image`=?, `description`=?, `capacity`=?, `model`=?, `motor_capacity`=?, `heater_capacity`=?, `shredder_capacity`=?, `power_reqirement`=?, `diamension`=?, `blower_capacity`=?, `heating_system`=?, `required_voltage`=?, `electrical_panel`=?, `display`=?, `carbon_filter`=?, `safty_feature`=?, `sensor`=?, `vfd_system`=?, `machine_paint`=?, `oil_tank_capacity`=?, `weight_of_machine`=?, `price`=? WHERE `id`=?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("sssssssssssssssssssssssi", $name, $filename, $description, $capacity, $model, $motor_capacity, $heater_capacity, $shredder_capacity, $power_reqirement, $diamension, $blower_capacity, $heating_system, $required_voltage, $electrical_panel, $display, $carbon_filter, $safty_feature, $sensor, $vfd_system, $machine_paint, $oil_tank_capacity, $weight_of_machine, $price, $id);
            } else {
                echo "Error preparing statement: " . $conn->error;
                exit;
            }
        } else {
            echo "Failed to upload image.";
            exit;
        }
    } else {
        // Image is not uploaded, update without changing the image
        $sql = "UPDATE `subproducts` SET `name`=?, `description`=?, `capacity`=?, `model`=?, `motor_capacity`=?, `heater_capacity`=?, `shredder_capacity`=?, `power_reqirement`=?, `diamension`=?, `blower_capacity`=?, `heating_system`=?, `required_voltage`=?, `electrical_panel`=?, `display`=?, `carbon_filter`=?, `safty_feature`=?, `sensor`=?, `vfd_system`=?, `machine_paint`=?, `oil_tank_capacity`=?, `weight_of_machine`=?, `price`=? WHERE `id`=?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssssssssssssssssssssssi", $name, $description, $capacity, $model, $motor_capacity, $heater_capacity, $shredder_capacity, $power_reqirement, $diamension, $blower_capacity, $heating_system, $required_voltage, $electrical_panel, $display, $carbon_filter, $safty_feature, $sensor, $vfd_system, $machine_paint, $oil_tank_capacity, $weight_of_machine, $price, $id);
        } else {
            echo "Error preparing statement: " . $conn->error;
            exit;
        }
    }

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>
                  alert('SubProduct updated successfully!!');
                  window.location.replace('subproducts.php');
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
