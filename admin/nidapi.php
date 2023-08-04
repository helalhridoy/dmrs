

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action="nidapiaction.php" method="post">
            <table>
                <tr>
                    <td>nid number</td>
                    <td>:</td>
                    <td>
                        <input type="number" name="nid_number">
                    </td>
                </tr>
                <tr>
                    <td>name</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="nid_name">
                    </td>
                </tr>
                <tr>
                    <td>date of birth</td>
                    <td>:</td>
                    <td>
                        <input type="date" name="nid_dob">
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Save"></td>
                </tr>
            </table>
        </form>
</body>
</html>