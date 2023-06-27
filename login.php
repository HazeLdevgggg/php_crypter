<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login</title> 
     <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Login</span></div>
        <form method ="post">
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" name="login_username" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="login_password"required>
          </div>
          <div class="row button">
            <input type="submit" value="Login">
          </div>
          <div class="signup-link">Not a member? <a href="sign-up.php">Signup now</a></div>
        </form>
      </div>
    </div>
  </body>
</html>

<?
    if (isset($_POST['login_username'], $_POST['login_password'])) {
        try {
            $serveur = "sportmarludev.mysql.db"; 
            $login = "sportmarludev"; 
            $pass = "DevMadein34"; 
            $connection = new PDO("mysql:host=$serveur;dbname=sportmarludev",$login, $pass); 
            $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $connection->prepare("SELECT username, password FROM user");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                foreach ($results as $results) {
                  $post_login = md5($_POST['login_username']);
                  $post_password = md5($_POST['login_password']);
                  $enter_unsername = $_POST['login_username'];
                  $username = $results['username'];
                  $password = $results['password'];

                    if ($post_login == $username && $password == $results['password']){
                      echo 'connecté';
                    }
                }
            } else {
                echo "Aucun utilisateur trouvé.";
            }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }    
?>