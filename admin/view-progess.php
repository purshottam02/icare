<?php
session_start();
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
    exit();
}
$id = $_GET['id'];

include '../dbconnection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>ICARE Apple Service Centre</title>

    <link rel="shortcut icon" href="assets/img/logoo2.jpg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="icon" type="image/png" href="uploads/logo/logo.jpg">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="main-wrapper">
        <?php include 'top.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header" style="background: aliceblue; padding: 16px 29px; border-radius: 5px;">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title active">In Progress Customers</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">In Progress Customers</li>
                            </ul>
                        </div>
<div class="col-auto text-right float-right ml-auto">
                             <!--<a class="btn btn-primary" onclick="exportTableToExcel('tblData')">Download</a> -->
                            <a href="view-cus.php?id=<?=$id?>" class="btn btn-primary">Back Page <i class="fas fa-plus"></i></a>
                        </div>

                    </div>

                    <style>
                        table {
                            border-collapse: collapse;
                            border-spacing: 0;
                            width: 100%;
                            border: 1px solid #ddd;
                        }

                        th,
                        td {
                            text-align: left;
                            padding: 8px;
                        }

                        tr:nth-child(even) {
                            background-color: #f2f2f2;
                        }
                    </style>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card ">
                            <div class="card-body" style="padding: 0px;">

                                <div class="table-responsive">
                                    <div class="d-flex justify-content-between mb-3" style="    margin: 17px;">
                                        <input id="myInput" type="text" class="form-control w-25"
                                            placeholder="Search...">
                                        <!-- Button to export selected data -->
                                        <button class="btn btn-primary" onclick="exportSelectedDataToPDF()">Export Selected Data</button>

                                        <!-- Include jsPDF and AutoTable -->
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>

                                        <script>
                                            function exportSelectedDataToPDF() {
                                                const {
                                                    jsPDF
                                                } = window.jspdf;
                                                const doc = new jsPDF();

                                                let table = document.getElementById("tblData");
                                                let rows = table.getElementsByTagName("tr");

                                                let data = [
                                                    ["First Name", "Last Name", "Email", "Mobile Number"] // Table headers
                                                ];

                                                for (let i = 1; i < rows.length; i++) { // Skip table header row
                                                    let cols = rows[i].getElementsByTagName("td");
                                                    if (cols.length > 0) {
                                                        let firstName = cols[1].innerText.trim();
                                                        let lastName = cols[2].innerText.trim();
                                                        let email = cols[3].innerText.trim();
                                                        let mobileNumber = cols[4].innerText.trim();

                                                        data.push([firstName, lastName, email, mobileNumber]);
                                                    }
                                                }

                                                // Add title
                                                doc.setFont("helvetica", "bold");
                                                doc.text("Selected Customer Data", 10, 10);

                                                // Use autoTable for table formatting
                                                doc.autoTable({
                                                    startY: 20,
                                                    head: [data[0]],
                                                    body: data.slice(1),
                                                });

                                                // Save the PDF
                                                doc.save("Selected_Customers.pdf");
                                            }
                                        </script>


                                        <button class="btn btn-primary" onclick="exportTableToExcel('tblData', 'Inprogress_Customers')">Export to Excel</button>
                                    </div>
                                    <table class="table table-hover table-center mb-0 datatable" id="tblData">
                                        <div class="col-lg-4 d-flex justify-conten-between "
                                            style="border:0px solid; font-size:20px; text-align:right; float: right;">
                                            <script
                                                src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
                                            </script>
                                            <script>
                                                $(document).ready(function() {
                                                    $("#myInput").on("keyup", function() {
                                                        var value = $(this).val().toLowerCase();
                                                        $("#tblData tr").filter(function() {
                                                            $(this).toggle($(this).text()
                                                                .toLowerCase().indexOf(value) >
                                                                -1)
                                                        });
                                                    });
                                                });
                                            </script>

                                            <!--<input id="myInput" type="text" placeholder="Search.." style="margin-bottom: 21px; margin-top: 21px; border: 1px solid #8080806b;-->
                                            <!-- padding: 5px 9px; font-size: 17px;">-->
                                        </div>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Mobile Number</th>
                                                <th>Address</th>
                                                <th>Device Brand</th>
                                                <th>Device Model</th>
                                                <th>IMEI Number</th>
                                                <th>Problem Description</th>
                                                <th>Repair Cost Estimate</th>
                                                <th>Repair Status</th>
                                                <th>Technician Assigned</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            include '../dbconnection.php';
                                            // Modify the SQL query to filter for pending repair status
                                            $sql = "SELECT * FROM customers WHERE repair_status = 'in progress' AND shop_id = '$id'
                                             ORDER BY customers.id DESC";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                $srno = 1;
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    <tr>
                                                        <td scope="row"><?= $srno ?></td>
                                                        <td><?= htmlspecialchars($row["first_name"]) ?></td>
                                                        <td><?= htmlspecialchars($row["last_name"]) ?></td>
                                                        <td><?= htmlspecialchars($row["email"]) ?></td>
                                                        <td><?= htmlspecialchars($row["mobile_number"]) ?></td>
                                                        <td><?= htmlspecialchars($row["address"]) ?></td>
                                                        <td><?= htmlspecialchars($row["device_brand"]) ?></td>
                                                        <td><?= htmlspecialchars($row["device_model"]) ?></td>
                                                        <td><?= htmlspecialchars($row["imei_number"]) ?></td>
                                                        <td><?php
                                                            // Fetch problem descriptions for the current customer
                                                            $sql_problem = "SELECT problem_description FROM customer_problem WHERE customer_id = " . intval($row['id']);
                                                            $result_problem = $conn->query($sql_problem);

                                                            if ($result_problem) { // Check if the query executed successfully
                                                                if ($result_problem->num_rows > 0) {
                                                                    while ($problem_row = $result_problem->fetch_assoc()) {
                                                                        // Check if the key exists before trying to access it
                                                                        if (isset($problem_row['problem_description'])) {
                                                            ?>
                                                                            <strong><?= htmlspecialchars($problem_row['problem_description']); ?></strong><br>
                                                            <?php
                                                                        } else {
                                                                            // Handle the case where the key does not exist
                                                                            echo "Problem description not available.";
                                                                        }
                                                                    }
                                                                } else {
                                                                    echo "No Problems Reported";
                                                                }
                                                            } else {
                                                                // Handle query error
                                                                echo "Error fetching problem descriptions: " . $conn->error;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= htmlspecialchars($row["repair_cost_estimate"]) ?></td>
                                                        <td style="color: blue;">
                                                            <?= htmlspecialchars($row["repair_status"]) ?>
                                                        </td>
                                                        <td><?= htmlspecialchars($row["technician_assigned"]) ?></td>

                                                        <td class="text-left">
                                                            <div class="actions">
                                                                <a href="editt.php?id=<?= $row["id"] ?>"
                                                                    class="btn btn-md bg-success-light">
                                                                    <i class="fas fa-edit"></i> 
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <!-- <td><?= htmlspecialchars($row["repair_warranty"]) ?></td> -->

                                                    </tr>
                                            <?php
                                                    $srno++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='15'>No Data In Database</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <footer>
                <p>Copyright © 2024</p>
            </footer>
        </div>
    </div>

    <!-- Scripts  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#tblData').DataTable(); // Initialize DataTable for enhanced search, pagination, and sorting

            // AJAX call for updating repair status
            $('.repair-status-update').change(function() {
                var customerId = $(this).data('customer-id');
                var newStatus = $(this).val();

                $.ajax({
                    url: 'update-repair-status.php',
                    method: 'POST',
                    data: {
                        id: customerId,
                        repair_status: newStatus
                    },
                    success: function(response) {
                        alert("Repair status updated successfully!");
                    },
                    error: function() {
                        alert("Error updating repair status.");
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tblData').DataTable();

            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tblData tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });

        function exportTableToExcel(tableID, filename = 'ExportedData') {
            var table = document.getElementById(tableID);
            var csv = [];
            var rows = table.querySelectorAll("tr");

            for (var i = 0; i < rows.length; i++) {
                var row = [],
                    cols = rows[i].querySelectorAll("td, th");
                for (var j = 0; j < cols.length; j++) {
                    row.push('"' + cols[j].innerText + '"');
                }
                csv.push(row.join(","));
            }

            var csvFile = new Blob([csv.join("\n")], {
                type: 'text/csv'
            });
            var downloadLink = document.createElement("a");
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.download = filename + ".csv";
            downloadLink.click();
        }
    </script>

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/datatables/datatables.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>