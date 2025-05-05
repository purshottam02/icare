<?php
session_start();
if (empty($_SESSION['admin_session'])) {
    header('Location: login.php');
    exit();
}

// Sanitize input ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

include '../dbconnection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>ICARE Apple Service Centre</title>

    <link rel="shortcut icon" href="assets/img/logoo2.jpg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
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
                <div class="page-header bg-light p-3 rounded">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title active">Completed Repairs</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Completed</li>
                            </ul>
                        </div>
                        <div class="col-auto text-right float-right ml-auto">
                             <!--<a class="btn btn-primary" onclick="exportTableToExcel('tblData')">Download</a> -->
                            <a href="view-cus.php?id=<?=$id?>" class="btn btn-primary">Back Page <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="d-flex justify-content-between mb-3">
                                        <input id="myInput" type="text" class="form-control w-25"
                                            placeholder="Search...">

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


                                        <button class="btn btn-primary" onclick="exportTableToExcel('tblData', 'Completed_Repairs')">Export to Excel</button>
                                    </div>

                                    <table class="table table-hover table-bordered datatable" id="tblData">
                                        <thead class="thead-light">
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
                                                <th>Repair Final Cost </th>
                                                <th>Repair Status</th>
                                                <th>Technician Assigned</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM customers WHERE repair_status = 'completed' AND shop_id = $id ORDER BY id DESC";
                                            $result = $conn->query($sql);
                                            
                                            if ($result && $result->num_rows > 0) {
                                                $srno = 1;
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    <tr>
                                                        <td><?= $srno ?></td>
                                                        <td><?= htmlspecialchars($row["first_name"]) ?></td>
                                                        <td><?= htmlspecialchars($row["last_name"]) ?></td>
                                                        <td><?= htmlspecialchars($row["email"]) ?></td>
                                                        <td><?= htmlspecialchars($row["mobile_number"]) ?></td>
                                                        <td><?= htmlspecialchars($row["address"]) ?></td>
                                                        <td><?= htmlspecialchars($row["device_brand"]) ?></td>
                                                        <td><?= htmlspecialchars($row["device_model"]) ?></td>
                                                        <td><?= htmlspecialchars($row["imei_number"]) ?></td>
                                                        <td>
                                                            <?php
                                                            $sql_problem = "SELECT problem_description FROM customer_problem WHERE customer_id = " . intval($row['id']);
                                                            $result_problem = $conn->query($sql_problem);

                                                            if ($result_problem && $result_problem->num_rows > 0) {
                                                                while ($problem_row = $result_problem->fetch_assoc()) {
                                                                    echo "<strong>" . htmlspecialchars($problem_row['problem_description']) . "</strong><br>";
                                                                }
                                                            } else {
                                                                echo "No Problems Reported";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= htmlspecialchars($row["repair_cost_estimate"]) ?></td>
                                                        <td><?= htmlspecialchars($row["finalcost"]) ?></td>

                                                        <td class="text-success"><?= htmlspecialchars($row["repair_status"]) ?></td>
                                                        <td><?= htmlspecialchars($row["technician_assigned"]) ?></td>
                                                        <td class="text-left" style="display: flex;">
                                                            <div class="actions">
                                                                <a href="editt.php?id=<?= $row["id"] ?> &&shopid=<?=$id?>"
                                                                    class="btn btn-md bg-success-light">
                                                                    <i class="fas fa-edit"></i> 
                                                                </a>
                                                            </div>
                                                            <div class="actions" style="margin-left: 20px;">
                                                                <a href="viewd.php?id=<?= $row["id"] ?> &&shopid=<?=$id?>"
                                                                    class="btn btn-md bg-success-light">
                                                                    <i class="fas fa-eye"></i> 
                                                                </a>
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                            <?php
                                                    $srno++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='13' class='text-center'>No Data In Database</td></tr>";
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
                <p class="text-center mt-3">Copyright © 2024</p>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/datatables/datatables.min.js"></script>
    <script src="assets/js/script.js"></script>

    <script>
        $(document).ready(function () {
            $('#tblData').DataTable();

            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#tblData tbody tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });

        function exportTableToExcel(tableID, filename = 'ExportedData') {
            var table = document.getElementById(tableID);
            var csv = [];
            var rows = table.querySelectorAll("tr");

            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll("td, th");
                for (var j = 0; j < cols.length; j++) {
                    row.push('"' + cols[j].innerText + '"');
                }
                csv.push(row.join(","));
            }

            var csvFile = new Blob([csv.join("\n")], { type: 'text/csv' });
            var downloadLink = document.createElement("a");
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.download = filename + ".csv";
            downloadLink.click();
        }
    </script>

</body>

</html>
