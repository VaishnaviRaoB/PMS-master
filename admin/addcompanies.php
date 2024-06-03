<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Company</title>
    <link rel="stylesheet" type="text/css" href="css/addcomp.css">
    <!-- Include necessary scripts for Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <?php include_once 'includes/head.php'; ?>
</head>

<body>
<?php include_once 'includes/nav.php'; ?>
    <div>
        <img id="img2" src="../images/walk.png" width="550px" style="position: absolute; position: fixed; z-index: 1; margin-left: 60%; margin-top: 50vh;">
    </div>
    <img src="../images/add.png" id="img1">
    <div class="content" style="margin-top: 40px; margin-left: 20px;">
        <h1 class="form-row justify-content-center" style="margin-left: 100px;">Add Company</h1> <br>
        <form action="php/addcomp.inc.php" autocomplete="off" method="POST">
            <input type="text" style="display: none;" autocomplete="false">
            <div class="row justify-content-center align-items-baseline">
                <div class="center one">
                    <div class="form-row">
                        <div class="form-group col-md-6 mx-5 sx-5" style="position:relative;left:4rem;">
                            <label for="cname">Company Name</label>
                            <input type="text" class="form-control" id="cname" name="cname" placeholder="Company Name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="website">Website</label>
                            <input type="url" pattern="^(https?:\/\/|www\.)[^\s$.?#].[^\s]*$" class="form-control" id="website" name="website" placeholder="Website" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ctype">Industry Type</label>
                            <select class="custom-select" id="ctype" name="ctype" required>
                                <option value="IT">IT</option>
                                <option value="BPO">BPO</option>
                                <option value="Consulting">Consulting</option>
                                <option value="Manufacturing">Manufacturing</option>
                                <option value="Healthcare">Healthcare</option>
                                <option value="Finance">Finance</option>
                                <option value="Retail">Retail</option>
                                <option value="Education">Education</option>
                                <option value="Hospitality">Hospitality</option>
                                <option value="Real Estate">Real Estate</option>
                                <option value="Telecommunications">Telecommunications</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select class="custom-select" id="status" name="status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telephone">Phone</label>
                            <input type="tel" pattern="^\d{10}$" class="form-control" id="telephone" name="telephone" placeholder="Phone" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="minperc">Minimum Percentage</label>
                            <input type="number" min="0" max="100" class="form-control" id="minperc" name="minperc" placeholder="Minimum Percentage" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" placeholder="Address" required></textarea>
                    </div>
                    <div class="form-row justify-content-center">
                        <button type="submit" class="btn" name="add" style="width: 250px; color: white; font-weight: bold; background: linear-gradient(to left, #4B83EA, #504EC2);">Add Company</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        // Prevent default behavior only for specific anchor tags if needed
        var anchorTags = document.querySelectorAll('a.prevent-default');
        for (var i = 0; i < anchorTags.length; i++) {
            anchorTags[i].addEventListener('click', function(event) {
                event.preventDefault();
            });
        }
    </script>
</body>
</html>





