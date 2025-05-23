<script>
function getcity(id) {
    xhr = new XMLHttpRequest();
    xhr.open('GET', 'test.php?idd=' + id, true);
    xhr.send();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("city_display").innerHTML = xhr.responseText;
        }
    }
}

function getEmail(emailid) {
    email = new XMLHttpRequest();
    email.open('GET', 'test2.php?email=' + emailid, true);
    email.send();
    email.onreadystatechange = function () {
        if (email.readyState == 4 && email.status == 200) {
            document.getElementById('emailDiv').innerHTML = email.responseText;
        }
    }
}

function getUsername(username) {
    user = new XMLHttpRequest();
    user.open('GET', 'check_username.php?username=' + username, true);
    user.send();
    user.onreadystatechange = function () {
        if (user.readyState == 4 && user.status == 200) {
            document.getElementById('userDiv').innerHTML = user.responseText;
        }
    }
}

function password() {
    var a = document.getElementById('pass1').value;
    var b = document.getElementById('pass2').value;
    if (a == b) {
        document.getElementById('cnfrmpass').innerHTML = "<font color='#00CC00'>Matched</font>";
    } else {
        document.getElementById('cnfrmpass').innerHTML = "<font color='red'>Miss matched</font>";
    }
}
</script>


<?php
include_once('config.php');
$result = mysqli_query($conn, 'select * from country');
if (!$result) {
    echo 'query failed';
}
?>

<?php if (isset($_GET['logout_successfully'])) { ?><?php echo $_GET['logout_successfully']; ?><?php } ?>
<table>
    <tr>
        <td colspan="2"><center><h1>Registration</h1></center></td>
    </tr>
    <tr>
    <td>Username:</td>
    <td><input type="text" name="username" onBlur="getUsername(this.value)" /></td>
    <td><div id="userDiv"></div></td>
</tr>

    <tr>
        <td>Email: </td>
        <td><input type="email" name="email" onBlur="getEmail(this.value)" /></td>
        <td><div id="emailDiv"></div></td>
    </tr>
    <tr>
        <td>Country: </td>
        <td>
            <select name="country">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo $row['country_id']; ?>"> <?php echo $row['country_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </td>
        <td><div id="city_display"></div></td>
    </tr>
    <tr>
        <td>Password: </td>
        <td><input type="password" name="pass1" id="pass1"/></td>
    </tr>
    <tr>
        <td>Confirm Password: </td>
        <td><input type="password" name="pass2" id="pass2" onblur="password()"/></td>
        <td><div id="cnfrmpass"></div></td>
    </tr>
    <tr>
        <td colspan="2"><center><input type="submit" name="sbt" /></center></td>
    </tr>
</table>
</form>

<?php if (isset($_GET['registration_successful'])) { ?><?php echo $_GET['registration_successful']; ?><?php } ?>

<form method="post" action="process.php">
    <table>
        <tr>
            <td colspan="2"><center><h1>Login</h1></center></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><input type="text" name="email"/></td>
        </tr>
        <tr>
            <td>Password: </td>
            <td><input type="password" name="password"/></td>
        </tr>
        <tr>
            <td colspan="2"><center><input type="submit" name="loginbtn"/></center></td>
        </tr>
    </table>
</form>

<?php if (isset($_GET['login_error'])) { ?><?php echo $_GET['login_error']; ?><?php } ?>
