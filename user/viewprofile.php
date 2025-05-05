<?php
session_start();
if (empty($_SESSION['user_session'])) {
    header('Location:index.php');
}
include '../conn.php';
$id = $_GET['id']; ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>iCARE Apple Service Centre</title>

    <link rel="icon" type="image/png" href="assets/img/logoo.jpg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="icon" type="image/png" href="uploads/logo/logo.jpg">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="main-wrapper">
        <?php include 'top.php';  ?>
        <?php include 'sidebar.php'; ?>
        <div class="page-wrapper" style="padding-top: 60px;">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Welcome <?php echo $_SESSION['user_session']['username'] ?>!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ul>
                        </div>
                        <div class="col-auto text-right float-right ml-auto">
                            <button onclick="print_page()" type="button" class="btn btn-outline-info mr-2"><i class="fas fa-print"></i> Print</button>

                            <!--   <a href="add.php" class="btn btn-primary"><i class="fas fa-envelope"></i> Email</a>  -->
                        </div>
                    </div>
                </div>
                <?php

                $sql = "SELECT * FROM  order_place WHERE user_id=$id";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc()

                ?>

                <div class="row ">
                    <div class="col-lg-12">
                        <div class="card ">
                            <div class="card-body">
                                <div id="invoice">
                                    <div class="invoice overflow-auto">
                                        <div>
                                            <header>
                                                <div class="row">
                                                    <div class="col">
                                                        <p><img src="../images/Ganga FB-01.png" width="100" alt=""></p>
                                                        <p style="margin: 0; padding: 0">
                                                            Address :
                                                            <br>

                                                        </p>
                                                    </div>
                                                    <div class="col company-details">
                                                        <h2 class="name">Ganga Ayurvedic<br>
                                                            <span></span>
                                                        </h2>
                                                        <div>+91 998 765 4321</div>
                                                        <div>info@yourdomailname.com</div>
                                                    </div>
                                                </div>
                                            </header>
                                            <main>
                                                <div class="row contacts">
                                                    <div style="border: 1px solid gray;border-radius: 5px;padding: 10px;" class="col-md-5">
                                                        Name : <?php echo $row['full_name']; ?>
                                                    </div>

                                                    <div style="border: 1px solid gray;border-radius: 5px;padding: 10px; margin-left: 140px;" class="col-md-5">
                                                        <b>Date of Invoice: &nbsp;<?= $row['order_date'] ?></b>
                                                    </div>
                                                </div>

                                                <table id="mytable" class="table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <!-- user_Id  -->
                                                            <th>Ser.No</th>
                                                            <th scope="col">Product name</th>
                                                            <th scope="col">wehight</th>
                                                            <th scope="col">Price</th>

                                                            <th scope="col">Quantity</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $srno = 0;
                                                        $sql = "SELECT * FROM  order_detail WHERE user_id=$id";
                                                        $result = $conn->query($sql);


                                                        while ($row = $result->fetch_assoc()) {
                                                            $srno = $srno + 1;
                                                        ?>
                                                            <tr>

                                                                <td><?php echo $srno; ?></td>
                                                                <td><?php echo $row['product_name']; ?></td>
                                                                <td><?php echo $row['product_weight']; ?></td>
                                                                <td>₹<?php echo $row['product_cost']; ?></td>

                                                                <td><?php echo $row['quantity']; ?></td>



                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <table>
                                                    <tbody style="font-size: small;">

                                                        <?php

                                                        $sql1 = "SELECT * FROM  order_place WHERE user_id=$id";
                                                        $result1 = $conn->query($sql1);
                                                        $row1 = $result1->fetch_assoc()

                                                        ?>
                                                        <tr>

                                                            <td><b>Subtotal</b></td>

                                                            <td style= "width:14rem;">₹ <?= $row1['Subtotal']; ?></td>
                                                        </tr>
                                                        <tr>

                                                            <td><b>Shipping and Handling</b></td>

                                                            <td style="width: 14rem;">₹ <?= $row1['Shipping']; ?></td>
                                                        </tr>
                                                        <tr>

                                                            <td><b>GST 18%</b></td>

                                                            <td style="width: 14rem;">₹ <?= $row1['GST']; ?></td>
                                                        </tr>
                                                        <tr>

                                                            <td><b>Payable Total</b></td>

                                                            <td style="width: 14rem;">₹ <?= $row1['PayableTotal']; ?></td>
                                                        </tr><br>




                                                    </tbody>
                                                </table>
                                                <br>
                                                <div class="thanks col-12 text-center">Thank you!</div>
                                                <div class="notices">
                                                    <!-- 
                                                    <div>NOTICE:</div> 
                                                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div> -->
                                                </div>
                                            </main>
                                            <h3 style="background: transparent;font-size:20px">Terms & Conditions</h3>
                                            <ul>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="row ">
                <div class="col-lg-10 ml-4">
                    <div class="card ">
                        <div class="card-body">
                            <form method="POST" action="demo2.php" enctype="multipart/form-data">
                                <label>Please mention your order is delivered or not</label>
                                <select name="feedback" class="form-control">
                                    <option value="Order Successfully Delivered">Order Successfully Delivered</option>
                                    <option value="Order Not Delivered">Order Not Delivered</option>
                                </select>
                                <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control">
                                <button type="submit" class="btn btn-success mt-4">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <style type="text/css">
        body {
            margin-top: 20px;
            background-color: #f7f7ff;
        }

        #invoice {
            padding: 0px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #0d6efd
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #0d6efd
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: 0px;
            font-size: 2em;
            margin-bottom: 10px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #0d6efd;
            background: #e7f2ff;
            padding: 10px;
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border: 2px solid black;
            margin-bottom: 20px
        }

        .invoice table td,
        .invoice table th {
            padding: 15px;
            border: 2px solid black;
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #0d6efd;
            font-size: 1.2em
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #0d6efd
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #0d6efd;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: 2px solid black;
        }

        .invoice table tfoot td {
            background: 0 0;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa;
        }


        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0px solid rgba(0, 0, 0, 0);
            border-radius: .25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        }

        .invoice table tfoot tr:last-child td {
            color: #0d6efd;
            font-size: 1.4em;
            border: 1px solid black
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #0d6efd;
            background: #e7f2ff;
            padding: 10px;
        }
    </style>

    <!-- Scripts  -->
    <script type="text/javascript">
        function print_page() {
            newwindow = window.open('print-invoice.php?id=<?= $userid ?>', 'print pdf', 'width=960,height=840,toolbar=0,menubar=0,location=0')
            setTimeout(function() {
                newwindow.document.close();
                newwindow.focus();
                newwindow.print();
                newwindow.close();
            }, 1000);
        }
    </script>
    <script src="assets/js/jquery-3.5.1.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="assets/plugins/apexchart/chart-data.js"></script>

    <script src="assets/js/script.js"></script>

</body>

</html>