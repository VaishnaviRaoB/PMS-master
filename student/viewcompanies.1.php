<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/addcomp.css"> -->
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
    </style>
</head>
<body>
    <?php include_once 'includes/nav.php' ?>
    <div class="container">
        <h1 class="form-row justify-content-center" style="margin-left: 100px;">View Company</h1> <br>
        <form method="GET">
            <div class="search-container">
                <input type="text" name="search" placeholder="Search Company">
                <button type="submit">Search</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover table-borderless table-light">
                <thead>
                    <tr>
                        <th scope="col">Company Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Website</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Status</th>
                        <th></th>
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
                                      <a href="editcomp.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm" name="deleteloc"><i class="fas fa-pen" style="color: #3498DB;"></i></a>
                                      <a href="php/crud.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm" name="deleteloc"><i class="fas fa-trash" style="color: red;"></i></a>
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
