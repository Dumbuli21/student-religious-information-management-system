<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VLE Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f2f2f2;
}

/* CENTER EVERYTHING */
.main-container {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* MAIN CARD */
.card-box {
    width: 850px;
    height: 420px;
    background: #9ccfc8;
    border-radius: 15px;
    display: flex;
    overflow: hidden;
}

/* LEFT SIDE */
.left {
    width: 50%;
    padding: 40px;
}

.left h3 {
    text-align: center;
    font-weight: bold;
}

.left hr {
    width: 60%;
    margin: 10px auto 20px;
}

/* INPUT */
.input-box {
    display: flex;
    align-items: center;
    border: 2px solid #2f7f77;
    border-radius: 10px;
    padding: 8px;
    margin-bottom: 15px;
    background: white;
}

.input-box i {
    margin-right: 10px;
    color: #2f7f77;
}

.input-box input {
    border: none;
    outline: none;
    width: 100%;
}

.eye {
    cursor: pointer;
}

/* BUTTON */
.login-btn {
    width: 120px;
    display: block;
    margin: 10px auto;
    background: #2f7f77;
    color: white;
    border: none;
    padding: 8px;
    border-radius: 20px;
}

.login-btn:hover {
    background: #256b63;
}

.link {
    text-align: center;
    font-size: 14px;
    margin-top: 10px;
}

/* GUEST BUTTON */
.guest-btn {
    display: block;
    margin: 15px auto;
    border: 1px solid #2f7f77;
    background: transparent;
    padding: 8px 15px;
    border-radius: 20px;
}

/* RIGHT SIDE */
.right {
    width: 50%;
    background: #f8f8f8;
    border-left: 2px dashed #2f7f77;
    text-align: center;
    padding: 30px;
}

.right img {
    width: 120px;
    margin-bottom: 10px;
}

.right h5 {
    font-size: 14px;
    font-weight: bold;
}

.contact {
    font-size: 13px;
    margin-top: 20px;
}
</style>

<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


</head>
<body>

<div class="main-container">
    <div class="card-box">

        <!-- LEFT -->
        <div class="left">
            <h3>Virtual Learning Environment</h3>
            <hr>

            <form>
                <!-- Username -->
                <label>Your Username</label>
                <div class="input-box">
                    <i class="fa fa-user"></i>
                    <input type="text" placeholder="Username">
                </div>

                <!-- Password -->
                <label>Password</label>
                <div class="input-box">
                    <i class="fa fa-lock"></i>
                    <input type="password" placeholder="Password">
                    <i class="fa fa-eye eye"></i>
                </div>

                <button class="login-btn">Log in</button>

                <p class="link">Lost password?</p>

                <button class="guest-btn">Access as a guest</button>
            </form>
        </div>

        <!-- RIGHT -->
        <div class="right">
            <img src="logo.png" alt="logo">

            <h5>MBEYA UNIVERSITY OF SCIENCE AND TECHNOLOGY</h5>

            <div class="contact">
                <p><b>CONTACT</b></p>
                <p>
                    Mbeya University of Science and Technology<br>
                    P.O. Box 131<br>
                    Mbeya, Tanzania
                </p>
                <p>📞 +255 25 295 7544</p>
                <p>✉ ict@must.ac.tz</p>
            </div>
        </div>

    </div>
</div>

</body>
</html>