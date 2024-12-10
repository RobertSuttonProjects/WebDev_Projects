<?php
session_start();

class UserAuthenticator
{
    
/*  isLoggedIn: Returns true or false depending upon if the user is logged in.
    authenticate: Accepts a username and password. If they’re correct, returns true. False otherwise.
    logUserIn: Creates the session record necessary to log the user in.
    logout: Logs the current user out.
    redirectToLogin: Redirects them to the login page. // i made it redirct to page since if the user is right itll instead go to index
*/
    private const USERNAME = "Programmer101";
    private const PASSWORD = "WebPrograms#101";

    public function isLoggedIn($currentUser)
    {
        return isset($_SESSION['username']);
    }

    public function authenticate($username, $password) {
        return $username === self::USERNAME && $password === self::PASSWORD;
    }
    public function logUserIn($username) {
        $_SESSION['username'] = $username;
        $this->redirectToPage("index.php");
    }
    public function logout() {
        session_destroy();
        $this->redirectToPage();
    }
    public function redirectToPage($pageURL = "login.php") {
        header("Location: " . $pageURL);
        exit();
    }
}
