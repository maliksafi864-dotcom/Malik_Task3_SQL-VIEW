<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Employee Details View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th {
            background-color: #0066cc;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #ddd;
            font-size: 13px;
        }
        tr:hover {
            background-color: #f8f9fa;
        }
        .location-cell {
            max-width: 300px;
            font-size: 12px;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>HR Employee Details Report</h1>
    
    <?php
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "index_db";
    
   
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    
    if ($conn->connect_error) {
        echo "<div class='error'>";
        echo "Connection failed: " . $conn->connect_error;
        echo "</div>";
    } else {
        echo "<div class='success'> Database connected!</div>";
        
    
        $sql = "SELECT * FROM employee_details_view";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            
            echo "<table>";
            
            
            echo "<tr>";
            while ($field = $result->fetch_field()) {
                echo "<th>" . $field->name . "</th>";
            }
            echo "</tr>";
            
          
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    if ($key == 'Location') {
                        echo "<td class='location-cell'>" . htmlspecialchars($value ?? 'N/A') . "</td>";
                    } else {
                        echo "<td>" . htmlspecialchars($value ?? 'N/A') . "</td>";
                    }
                }
                echo "</tr>";
            }
            
            echo "</table>";
            
            
            echo "<p style='margin-top: 20px; font-weight: bold;'>Total records: " . $result->num_rows . "</p>";
            
        } else {
            echo "<div class='error'>No records found in the view.</div>";
        }
      
        $conn->close();
    }
    ?>
</body>

</html>
