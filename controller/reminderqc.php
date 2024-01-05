<?php
class ReminderQCController
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function createProduct($number, $name, $variables)
  {
    $lines = explode("\n", $variables);
    $resultArray = [];
    foreach ($lines as $line) {
      $values = explode(";", $line);
      $resultArray[] = $values;
    }

    $dataArray = [];
    foreach ($lines as $line) {
      $line = trim($line);
      if (!empty($line)) {
        $dataArray[] = $line;
      }
    }

    $jsonArray = json_encode($resultArray);

    $query = "INSERT INTO products (number, name, variables) VALUES (?, ?, ?)";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('sss', $number, $name, $jsonArray);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function editProduct($id, $number, $name, $variables)
  {
    $lines = explode("\n", $variables);
    $resultArray = [];
    foreach ($lines as $line) {
      $values = explode(";", $line);
      $resultArray[] = $values;
    }

    $dataArray = [];
    foreach ($lines as $line) {
      $line = trim($line);
      if (!empty($line)) {
        $dataArray[] = $line;
      }
    }

    $jsonArray = json_encode($resultArray);

    $query = "UPDATE products SET number = ?, name = ?, variables = ? WHERE id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('sssi', $number, $name, $jsonArray, $id);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getProduct($id)
  {
    $query = "
    SELECT * FROM products WHERE id = ?";

    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row;
  }

  public function getProducts()
  {
    $query = "
      SELECT 
        p.id AS id,
        p.number AS number,
        p.name AS name,
        COUNT(b.id) AS batch_count
      FROM products p
      LEFT JOIN batches b ON p.id = b.product_id
      GROUP BY p.id
      ";
    $result = $this->db->query($query);

    $items = array();
    while ($row = $result->fetch_assoc()) {
      $items[] = $row;
    }

    return $items;
  }

  public function getBatchesByProduct($id)
  {
    $query = "
    SELECT 
      products.number, 
      products.name, 
      batches.id, 
      product_id, 
      batch_number, 
      mfg_date, 
      exp_date, 
      sample_date, 
      types, 
      storage_conditions, 
      packaging_type,
      status, 
      batches.created_at, 
      batches.updated_at 
    FROM batches
    INNER JOIN products ON products.id = batches.product_id 
    WHERE product_id = ?";

    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $items = array();
    while ($row = $result->fetch_assoc()) {
      $items[] = $row;
    }

    return $items;
  }

  public function createBatch($product_id, $batch_number, $mfg_date, $exp_date, $sample_date, $types, $storage_conditions, $packaging_type)
  {
    $query = "INSERT INTO batches (product_id, batch_number, mfg_date, exp_date, sample_date, types, storage_conditions, packaging_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('isssssss', $product_id, $batch_number, $mfg_date, $exp_date, $sample_date, $types, $storage_conditions, $packaging_type);

    if ($stmt->execute()) {
      return $this->db->insert_id;
    } else {
      return false;
    }
  }

  public function createTestsByBatch($batch_id, $sample_date, $exp_date, $types)
  {
    $exp_date_plus_5_year = clone $exp_date;
    $exp_date_plus_5_year->add(new DateInterval('P5Y'));
    $clonedSampleDate = clone $sample_date;
    $bulan_ke = 0;

    while ($clonedSampleDate <= $exp_date_plus_5_year) {
      foreach ($types as $type) {
        if ($type == 'accelerated' && in_array($bulan_ke, [0, 3, 6])) {
          $this->createTest($type, $batch_id, $clonedSampleDate->format('Y-m-d'), $bulan_ke);
        }
        if ($type == 'realtime' && in_array($bulan_ke, [0, 3, 6, 9, 12, 18, 24, 36])) {
          $this->createTest($type, $batch_id, $clonedSampleDate->format('Y-m-d'), $bulan_ke);
        }
        if ($type == 'ongoing' && in_array($bulan_ke, [12, 24, 36, 48, 60, 72, 84])) {
          $this->createTest($type, $batch_id, $clonedSampleDate->format('Y-m-d'), $bulan_ke);
        }
      }
      $clonedSampleDate->add(new DateInterval('P3M'));
      $bulan_ke += 3;
    }
  }

  public function createTest($type, $batch_id, $clonedSampleDate, $bulan_ke)
  {
    $query = "INSERT INTO tests (type, batch_id, date, month) VALUES (?, ?, ?, ?)";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('ssss', $type, $batch_id, $clonedSampleDate, $bulan_ke);
    return $stmt->execute();
  }

  public function getCalendarEvents()
  {
    $query = "
      SELECT
        tests.id,
        CONCAT('[',UPPER(LEFT(tests.type, 1)), '] ', batches.batch_number, ' ', products.name) AS title, 
        date AS start,
        CASE 
          WHEN date >= CURDATE() AND tests.sample_received = 0 AND tests.status = 0 THEN 'orange'
          WHEN date < CURDATE() AND tests.sample_received = 0 AND tests.status = 0 THEN 'red'
          WHEN date >= CURDATE() AND tests.sample_received = 1 AND tests.status = 0 THEN 'brown'
          WHEN tests.status = 1 THEN 'green'
          ELSE 'black'
        END AS color,
        tests.status
      FROM tests 
      JOIN batches ON tests.batch_id = batches.id 
      JOIN products ON batches.product_id = products.id;
      ";

    $result = $this->db->query($query);

    $items = array();
    while ($row = $result->fetch_assoc()) {
      $items[] = $row;
    }

    return $items;
  }

  public function getCalendarEventDetail($id)
  {
    $query = "
    SELECT
      tests.id,
      tests.type,
      products.number AS item_number,
      products.name AS product_name,
      date,
      tests.status,
      tests.sample_received,
      tests.handover
    FROM tests
    JOIN batches ON tests.batch_id = batches.id
    JOIN products ON batches.product_id = products.id
    WHERE tests.id = ?
    ";

    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  public function getTestsByBatch($batch_id)
  {
    $query = "
    SELECT 
        p.number as product_number,
        p.name as product_name,
        b.batch_number,
        b.mfg_date,
        b.exp_date,
        b.types,
        t.id,
        t.type,
        t.date,
        t.month,
        t.detail
    FROM products p
    JOIN batches b ON p.id = b.product_id
    LEFT JOIN tests t ON b.id = t.batch_id
    WHERE b.id = ?
    ";

    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $batch_id);

    $stmt->execute();

    $result = $stmt->get_result();

    $formattedData = [];

    while ($row = $result->fetch_assoc()) {
      $formattedData['product_number'] = $row['product_number'];
      $formattedData['product_name'] = $row['product_name'];
      $formattedData['batch_number'] = $row['batch_number'];
      $formattedData['mfg_date'] = $row['mfg_date'];
      $formattedData['exp_date'] = $row['exp_date'];
      $formattedData['types'] = $row['types'];
      $formattedData['tests'][] = [
        'id' => $row['id'],
        'type' => $row['type'],
        'date' => $row['date'],
        'month' => $row['month'],
        'detail' => $row['detail'],
      ];
    }

    return $formattedData;
  }

  public function getTest($id)
  {
    $query = "
    SELECT
        t.id AS test_id,
        t.type,
        t.month,
        t.detail,
        b.batch_number,
        b.mfg_date,
        b.exp_date,
        b.sample_date,
        b.storage_conditions,
        p.name AS product_name,
        p.number AS product_number,
        p.variables
    FROM tests t
    INNER JOIN batches b ON t.batch_id = b.id
    INNER JOIN products p ON b.product_id = p.id
    WHERE t.id = ?
    ";

    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $id);

    $stmt->execute();

    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    $response = [
      'id' => $row['test_id'],
      'type' => $row['type'],
      'month' => $row['month'],
      'detail' => $row['detail'],
      'batch_number' => $row['batch_number'],
      'mfg_date' => $row['mfg_date'],
      'exp_date' => $row['exp_date'],
      'sample_date' => $row['sample_date'],
      'storage_conditions' => $row['storage_conditions'],
      'product_name' => $row['product_name'],
      'product_number' => $row['product_number'],
      'variables' => $row['variables'],
    ];

    return $response;
  }

  public function inputTestResult($formData, $id)
  {
    unset($formData['id']);
    $jsonData = json_encode($formData);

    $query = "UPDATE tests SET detail = ?, status = 1 WHERE id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('si', $jsonData, $id);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function inputTestSample($formData, $id)
  {
    // unset($formData['id']);
    // unset($formData['signature_data']);
    $base64Data = $formData['signature_data'];

    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Data));
    $filename = 'signature_' . time() . '.png';

    $formData['filename'] = $filename;
    file_put_contents(__DIR__ . '/signatures/' . $filename, $imageData);

    $jsonData = json_encode($formData);
    $query = "UPDATE tests SET handover = ?, sample_received = 1 WHERE id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('si', $jsonData, $id);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getProductsThatHaveBatch()
  {
    $query = "
      SELECT DISTINCT p.*
      FROM products p
      INNER JOIN batches b ON p.id = b.product_id;";

    $result = $this->db->query($query);

    $items = array();
    while ($row = $result->fetch_assoc()) {
      $items[] = $row;
    }

    return $items;
  }

  function format($data)
  {
    $result = [];
    foreach ($data as $innerArray) {
      $result[] = implode(';', $innerArray);
    }
    $output = implode('', $result);
    return $output;
  }
}
