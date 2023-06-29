<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="inner-container">
            <div class="greeting">
                <h2>Hey, Hello<span id="greeting-name"></span>👋</h2>
            </div>
            <form action="" class="login-form">
                <div class="login-form-header">
                    <div class="form-row">
                        <div class="form-col">
                            <label for="name-input">Naam</label>
                            <input type="text" placeholder="vul hier je naam" id="name-input">
                            <span class="error-message"></span>
                        </div>
                        <div class="form-col">
                            <label for="name-input">Gebruikersnaam</label>
                            <input type="text" placeholder="vul hier je naam" id="name-input">
                            <span class="error-message"></span>
                        </div>
                    </div>
                    <div class="form-col">
                        <label for="name-input">Password</label>
                        <input type="password" placeholder="vul hier je wachtwoord in" id="password-input">
                        <span class="error-message"></span>
                    </div>
                    <div class="form-col">
                        <label for="name-input">Bevestig Wachtwoord</label>
                        <input type="password" placeholder="vul hier je wachtwoord in" id="password-input-2">
                        <span class="error-message"></span>
                    </div>
                </div>
                <div class="login-form-bottom">
                    <div class="form-col">
                        <button class="login-sbmt">
                            Login
                        </button>
                        <span>Nog geen account?<a href="/signup">Account aanmaken</a></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script></script>
</body>

</html>