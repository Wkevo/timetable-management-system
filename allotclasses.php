
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>TimeTable Management System</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <!-- FONT AWESOME CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- FLEXSLIDER CSS -->
    <link href="assets/css/flexslider.css" rel="stylesheet"/>
    <!-- CUSTOM STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet"/>
    <!-- Google	Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'/>
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top " id="menu">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div class="navbar-collapse collapse move-me">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="addteachers.php">ADD LECTURERS</a></li>
                <li><a href="addsubjects.php">ADD UNITS</a></li>
                <li><a href="addclassrooms.php">ADD VENUES</a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">ALLOTMENT
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href=allotsubjects.php>THEORY COURSES</a>
                        </li>
                        <li>
                            <a href=allotpracticals.php>PRACTICAL COURSES</a>
                        </li>
                        <li>
                            <a href=allotclasses.php>VENUES</a>
                        </li>
                    </ul>
                </li>
                <li><a href="generatetimetable.php">GENERATE TIMETABLE</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php">LOGOUT</a></li>
            </ul>

        </div>
    </div>
</div>
<!--NAVBAR SECTION END-->
<br>

<?php
if (isset($_POST['in_class'])) {
    include 'connection.php';
    $year = $_POST['course'];
    $class = $_POST['in_class'];
    $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
        "UPDATE classrooms SET status = '$year' WHERE name = '$class'");
}
?>
<form action="allotclasses.php" method="post" style="margin-top: 100px">

    <div align="center">
        <select name="course" class="list-group-item">
            <option selected disabled>Select Course</option>
           ';
            <option value="1">SIT 1ST Year</option> 
            <option value="2">SIT 2nd Year</option>
            <option value="3">SIT 3rd Year</option>
            <option value="4">SIT 4rth Year</option>
            <option value="5">COM 1ST Year</option>
            <option value="6">COM 2nd Year</option>
            <option value="7">COM 3rd Year</option>
            <option value="8">COM 4rth Year</option>
             <option value="9">SIK 1ST Year</option>
            <option value="10">SIK 2nd Year</option>
            <option value="11">SIK 3rd Year</option>
            <option value="12">SIK 4rth Year</option>
             <option value="13">ETS 1ST Year</option>
            <option value="14">ETS 2nd Year</option>
            <option value="15">ETS 3rd Year</option>
            <option value="16">ETS 4rth Year</option>
            
        </select>
    </div>

    <div align="center" style="margin-top: 5px">
        <select name="in_class" class="list-group-item">
            <?php
            include 'connection.php';
            $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                "SELECT * FROM classrooms");
            $row_count = mysqli_num_rows($q);
            if ($row_count) {
                $mystring = '
             <option selected disabled>Select Venue</option>';
                while ($row = mysqli_fetch_assoc($q)) {
                    if ($row['status'] != 0)
                        continue;
                    $mystring .= '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                }
                echo $mystring;
            }
            ?>
        </select>
    </div>
    <div align="center" style="margin-top: 10px;">
        <button type="submit" class="btn btn-success btn-lg">Allot</button>
    </div>
</form>

<script>
    function deleteHandlers() {
        var table = document.getElementById("allotedsubjectstable");
        var rows = table.getElementsByTagName("tr");
        for (i = 0; i < rows.length; i++) {
            var currentRow = table.rows[i];
            //var b = currentRow.getElementsByTagName("td")[0];
            var createDeleteHandler =
                function (row) {
                    return function () {
                        var cell = row.getElementsByTagName("td")[0];
                        var id = cell.innerHTML;
                        var x;
                        if (confirm("Are You Sure?") == true) {
                            window.location.href = "deleteallotment.php?name=" + id;

                        }

                    };
                };

            currentRow.cells[2].onclick = createDeleteHandler(currentRow);
        }
    }
</script>
<div align="center">
    <style>
        table {
            margin-top: 70px;
            margin-bottom: 50px;
            font-family: arial, sans-serif;
            border-collapse: collapse;
            margin-left: 80px;
            width: 90%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>

    <table id=allotedclassroomstable>
        <caption><strong>VENUES ALLOTMENT</strong></caption>
        <tr>
            <th width="250">Venue</th>
            <th width="400">Alloted To</th>
            <th width="60">Action</th>
        </tr>
        <tbody>
        <?php
        include 'connection.php';
        $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
            "SELECT * FROM classrooms ");
        $courses = array('SIT 1ST YEAR', 'SIT 2ND YEAR', 'SIT 3RD YEAR', 'SIT 4TH YEAR','COM 1ST YEAR', 'COM 2ND YEAR', 'COM 3RD YEAR', 'COM 4TH YEAR', 'SIK 1ST YEAR', 'SIK 2ND YEAR', 'SIK 3RD YEAR', 'SIK 4TH YEAR', 'ETS 1ST YEAR', 'ETS 2ND YEAR',  'ETS 3RD YEAR', 'ETS 4TH YEAR');
        while ($row = mysqli_fetch_assoc($q)) {
            if ($row['status'] == 0)
                continue;

            echo "<tr><td>{$row['name']}</td>
                    <td>{$courses[$row['status']-1]}</td>
                <td><button>Delete</button></td>
                    </tr>\n";
        }
        echo "<script>deleteHandlers();</script>";
        ?>
        </tbody>
    </table>
</div>
<!--HOME SECTION END-->

<!-- FOOTER SECTION END-->

<!--  Jquery Core Script -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!--  Core Bootstrap Script -->
<script src="assets/js/bootstrap.js"></script>
<!--  Flexslider Scripts -->
<script src="assets/js/jquery.flexslider.js"></script>
<!--  Scrolling Reveal Script -->
<script src="assets/js/scrollReveal.js"></script>
<!--  Scroll Scripts -->
<script src="assets/js/jquery.easing.min.js"></script>
<!--  Custom Scripts -->
<script src="assets/js/custom.js"></script>
</body>
</html>
