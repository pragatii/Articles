<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"></head>
<body style="background-color: midnightblue;">
<div  style="width:400px;  margin-top:100px; margin-left: 500px; background-color: midnightblue; color: aliceblue">
<h1 align="middle">SIGN UP!!</h1>
</div>
<div class="well" style="width:600px; height: 400px ; margin:0px auto;">
    <form class="form-horizontal" method="post" action="reg_submit.php" aligm="middle">
        <div class="form-group">
            <label class="col-md-4 control-label">NAME:</label>
            <div class="col-md-6">
                <input name="name" class="form-control" type="text"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">EMAIL:</label>
            <div class="col-md-6">
                <input name="email" class="form-control" type="email"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">PASSWORD:</label>
            <div class="col-md-6">
                <input name="password" class="form-control" type="password"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">DATE OF BIRTH:</label>
            <div class="col-md-6">
                <input name="dob" class="form-control" type="date"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12 btn">
                <button type="submit" class="btn btn-primary">
                    Register
                </button>
                <a href="login.php" class="btn btn-primary">Login</a>

            </div>


        </div>
    </form>
</div>
</body>
</html>

