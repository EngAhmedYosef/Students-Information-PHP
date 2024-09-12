<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <title>A simple student administration project, adding and deleting students</title>
    <style>
        body {
            background-color: whitesmoke;
            font-family: "Tajawal", sans-serif;
        }

        #mother {
            font-size: 20px;
            width: 100%;

        }

        main {
            float: left;
            border: 1px solid gray;
            padding: 5px;
        }

        input {
            padding: 4px;
            border: 2px solid black;
            text-align: center;
            font-size: 17px;
            font-family: "Tajawal", sans-serif;

        }

        aside {
            text-align: center;
            width: 300;
            float: right;
            border: 1px solid black;
            padding: 10px;
            font-size: 20px;
            background-color: silver;
            color: white;

        }

        #tbl {
            width: 890px;
            font-size: 20px;
        }

        #tbl th {
            background-color: silver;
            color: black;
            font-size: 20px;
            padding: 10px;
        }

        aside button {
            width: 190;
            padding: 8px;
            margin-top: 7px;
            font-size: 17px;
            font-family: "Tajawal", sans-serif;
            font-weight: bold;

        }
    </style>
</head>

<body dir="rtl">
    <?php
    #الاتصال بقاعدة البيانات
    $localhost = "localhost";
    $username = "root";
    $pass = "";
    $db = "student";
    $con = mysqli_connect($localhost, $username, $pass, $db);
    $res = mysqli_query($con, "select * from student");

    // request variable
    $id = "";
    $name = "";
    $address = "";

    if (isset($_POST["id"])) {
        $id = $_POST["id"];
    }

    if (isset($_POST["name"])) {
        $name = $_POST["name"];
    }

    if (isset($_POST["address"])) {
        $address = $_POST["address"];
    }

    $sqls = "";
    if (isset($_POST["add"])) {
        $sqls = "insert into student value($id,'$name','$address')";
        mysqli_query($con, $sqls);
        header("location:home.php");
    }

    if (isset($_POST["del"])) {
        $sqls = "delete from student where name = '$name'";
        mysqli_query($con, $sqls);
        header("location:home.php");
    }
    ?>
    <div id="mother">
        <form method="POST">
            <!-- لوحة التحكم-->
            <aside>
                <div id="div">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUByVq_RjQ_1CbSXmImIdhkCwFr2Tr9BBvMQ&s" alt="لوجو الموقع" width="200">
                    <h3>لوحة المدير</h3>
                    <label>رقم الطالب</label><br>
                    <input type="text" name="id" id="id"><br>
                    <label>اسم الطالب</label><br>
                    <input type="text" name="name" id="name"><br>
                    <label>عنوان الطالب</label><br>
                    <input type="text" name="address" id="address"><br><br>
                    <button name="add"> اضافة طالب</button>
                    <button name="del">حذف الطالب</button>
                </div>
            </aside>
            <!--  عرض بيانات الطلاب-->
            <main>
                <table id="tbl">
                    <tr>
                        <th>الرقم التسلسلى </th>
                        <th>اسم الطالب</th>
                        <th>عنوان الطالب</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($res)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </main>
        </form>
    </div>
</body>

</html>