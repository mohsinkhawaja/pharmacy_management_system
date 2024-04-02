<?php
$con = mysqli_connect("localhost", "root", "", "newpharmacy");

// Get customers data
$sql_customers = "SELECT * FROM customers";
$rec_customers = mysqli_query($con, $sql_customers);

// Function to generate invoice number
function generateInvoiceNumber($con) {
  $sql_invoice_count = "SELECT COUNT(*) AS invoice_count FROM invoices";
  $result_invoice_count = mysqli_query($con, $sql_invoice_count);
  $row_invoice_count = mysqli_fetch_assoc($result_invoice_count);
  return $row_invoice_count['invoice_count'] + 1;
}

// Handle form submissions (add invoice, add medicine to invoice)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == "Add Invoice") {
      $invoice_date = $_POST['invoice_date'];
      $customer_id = $_POST['customer_id'];

      $invoice_number = generateInvoiceNumber($con);

      $sql_insert_invoice = "INSERT INTO invoices (invoice_id, invoice_date, customer_id) VALUES ($invoice_number, '$invoice_date', $customer_id)";

      if (mysqli_query($con, $sql_insert_invoice)) {
        echo "<script language='javascript1.2'>window.location='invoice_entry.php?msg=Invoice Created Successfully';</script>";
      } else {
        echo "Error creating invoice: " . mysqli_error($con);
      }
    } else if ($action == "Add Medicine") {
      $invoice_id = $_POST['invoice_id'];
      $medicine_id = $_POST['medicine_id'];
      $quantity = $_POST['quantity'];
      $discount = $_POST['discount'];

      // Get medicine price
      $sql_medicine_price = "SELECT sell_cost FROM medicine WHERE m_id=$medicine_id";
      $result_medicine_price = mysqli_query($con, $sql_medicine_price);
      $row_medicine_price = mysqli_fetch_assoc($result_medicine_price);
      $price = $row_medicine_price['sell_cost'];

      $total = $price * $quantity;
      $discounted_total = $total * (1 - $discount / 100);

      $sql_insert_invoice_medicine = "INSERT INTO invoice_medicine (invoice_id, medicine_id, quantity, price, discount, total) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($con, $sql_insert_invoice_medicine);
      mysqli_stmt_bind_param($stmt, "iiiddd", $invoice_id, $medicine_id, $quantity, $price, $discount, $discounted_total);
      mysqli_stmt_execute($stmt);

      if ($stmt) {
        echo "<script language='javascript1.2'>window.location='invoice_entry.php?invoice_id=$invoice_id&msg=Medicine Added Successfully';</script>";
      } else {
        echo "Error adding medicine to invoice: " . mysqli_error($con);
      }
    }
  }
}

// Get invoice ID from URL (for editing existing invoice)
$invoice_id = isset($_REQUEST['invoice_id']) ? $_REQUEST['invoice_id'] : null;

// Get invoice details if editing
if ($invoice_id) {
  $sql_invoice = "SELECT * FROM invoices WHERE invoice_id=$invoice_id";
  $result_invoice = mysqli_query($con, $sql_invoice);
  $row_invoice = mysqli_fetch_assoc($result_invoice);

  $invoice_date = $row_invoice['invoice_date'];
  $customer_id = $row_invoice['customer_id'];



  // Get invoice medicines
  $sql_invoice_medicines = "SELECT im.*, m.m_name FROM invoice_medicine im JOIN medicine m ON im.medicine_id = m.m_id WHERE invoice_id=$invoice_id";
  $result_invoice_medicines = mysqli_query($con, $sql_invoice_medicines);
}

// Get medicines data
$sql_medicines = "SELECT * FROM medicine";
$rec_medicines = mysqli_query($con, $sql_medicines);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Create Invoice</title>
</head>

<body>

  <?php
  if (isset($_REQUEST['msg'])) {
    echo "<p style='color: blue;'>" . $_REQUEST['msg'] . "</p>";
  }
  ?>

  <h2>Create New Invoice</h2>
  <form action="invoice_entry.php" method="post">
    <label for="invoice_date">Date:</label><br>
    <input type="date" id="invoice_date" name="invoice_date" value="<?php echo date('Y-m-d'); ?>"><br><br>

    <label for="customer_id">Customer Name:</label><br>
    <select id="customer_id" name="customer_id">
      <?php
      while ($row_customer = mysqli_fetch_assoc($rec_customers)) {
        $selected = ($row_customer['c_id'] == $customer_id) ? "selected" : "";
        echo "<option value='" . $row_customer['c_id'] . "' $selected>" . $row_customer['c_name'] . "</option>";
      }
      ?>
    </select><br><br>

    <input type="submit" name="action" value="Add Invoice">
  </form>
  <hr>
  <h2>Invoice Details</h2>
  <form action="invoice_entry.php" method="post">
    <input type="hidden" name="invoice_id" value="<?php echo $invoice_id; ?>">
    <label for="medicine_id">Medicine Name:</label><br>
    <select id="medicine_id" name="medicine_id">
      <?php
      while ($row_medicine = mysqli_fetch_assoc($rec_medicines)) {
        echo "<option value='" . $row_medicine['m_id'] . "'>" . $row_medicine['m_name'] . "</option>";
      }
      ?>
    </select><br><br>

    <label for="quantity">Quantity:</label><br>
    <input type="number" id="quantity" name="quantity" value="1"><br><br>

    <label for="discount">Discount (%):</label><br>
    <input type="number" id="discount" name="discount" value="0"><br><br>

    <input type="submit" name="action" value="Add Medicine">
  </form>
  <hr>
  <h2>Invoice Medicines</h2>
  <?php
  if ($invoice_id) {
    if ($result_invoice_medicines) {
  ?>
      <table border="1">
        <tr>
          <th>Medicine Name</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Discount</th>
          <th>Total</th>
        </tr>
        <?php
        while ($row_invoice_medicine = mysqli_fetch_assoc($result_invoice_medicines)) {
          echo "<tr>";
          echo "<td>" . $row_invoice_medicine['m_name'] . "</td>";
          echo "<td>" . $row_invoice_medicine['quantity'] . "</td>";
          echo "<td>" . $row_invoice_medicine['price'] . "</td>";
          echo "<td>" . $row_invoice_medicine['discount'] . "%</td>";
          echo "<td>" . $row_invoice_medicine['total'] . "</td>";
          echo "</tr>";
        }
        ?>
      </table>
  <?php
    } else {
      echo "<p>No invoice medicines found.</p>";
    }
  }
  ?>
</body>

</html>
