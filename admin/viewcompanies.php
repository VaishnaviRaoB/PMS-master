<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Trainings</title>
    <?php include_once 'includes/head.php' ?>
    <style>
        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .search-container input[type=text] {
            padding: 10px;
            width: 400px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            outline: none;
        }
        .search-container button {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
        }
        .search-container button:hover {
            background-color: #45a049;
        }
        .table-container {
            margin-top: 30px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table thead th {
            background-color: #f8f9fa;
            font-weight: bold;
            width: 50px;
            border-bottom: 1px solid #dee2e6;
            border-top: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6; /* Add vertical line */
        }
        .table thead th:first-child {
          
            border-left: 1px solid #dee2e6; /* Add vertical line before the first column */
        }
        .table thead th:last-child {
            border-right:1px solid #dee2e6 ; /* Remove vertical line after the last column */
        }
        .table td, .table th {
            
            vertical-align: middle;
            border-right: 1px solid #dee2e6; /* Extend vertical line for entire column */
        }
        .table td:last-child, .table th:last-child {
            border-right: 1px solid #dee2e6; /* Remove vertical line for last column */
        }
        .table td:first-child, .table th:first-child {
            border-left: 1px solid #dee2e6; /* Add vertical line before the first column */
        }
        .table td {
            padding: 10px 10px ;
            border-bottom: 1px solid #dee2e6;
            
        }
        .btn-sm {
            padding: 5px 5px;
            margin: 0 0px;
            font-size: 0.8rem;
            
        }
        .fas {
            font-size: 1em;
            ;
        }
        .no-trainings {
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <?php include_once 'includes/nav.php' ?>
    <div class="container" style="z-index: 2;">
        <h1 class="form-row justify-content-center mt-4">Companies</h1>
        <div class="search-container mt-4">
            <form method="GET">
                <input type="text" name="search" placeholder="Search Course by Name">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover table-borderless table-light">
                <thead>
                    <tr>
                        <th scope="col">Company Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Website</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                        if(isset($_GET['search'])) {
                          $search = mysqli_real_escape_string($conn, $_GET['search']);
                          $sql = "SELECT * FROM company WHERE name LIKE '%$search%' ORDER BY id;";
                      } else {
                          $sql = "SELECT * FROM company ORDER BY id;";
                      }
                      $res = mysqli_query($conn, $sql);
                      $rescheck = mysqli_num_rows($res);
                      if($rescheck > 0) {
                          while ($row = mysqli_fetch_assoc($res)) {
                              echo '<tr>';
                                  echo '<td>'.$row['name'].'</td>';
                                  echo '<td>'.$row['type'].'</td>';
                                  echo "<td><a href='" . htmlspecialchars($row["website"]) . "' target='_blank'>" . htmlspecialchars($row["website"]) . "</a></td>";
                                  echo '<td>'.$row['number'].'</td>';
                                  echo '<td>'.$row['status'].'</td>';
                                  ?>
                                  <td>
                                      <a href="editcomp.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary" name="edit"><i class="fas fa-pen"></i></a>
                                      <a href="php/crud.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" name="delete"><i class="fas fa-trash"></i></a>
                                  </td>
                                  <?php
                              echo '</tr>';
                          }
                      } else {
                          echo '<tr><td colspan="6">No records found.</td></tr>';
                      }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include_once 'includes/footer.php' ?>
</body>
</html>
