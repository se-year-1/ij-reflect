<?php

// Start session
require_once 'vendor/autoload.php';

//session_start();

class User_Authentication extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->utility->require_level(0);
    }

    public function index() {

        // require_once 'vendor/autoload.php' DOES THIS vvvvvvvvvv
        // Include two files from google-php-client library in controller
        //        include_once APPPATH . '/html/vendor/google/apiclient/src/Google/Client.php';
        //        include_once APPPATH . '/html/vendor/google/apiclient-services/Google/Service/Oauth2.php';
// Store values in variables from project created in Google Developer Console
        $client_id = 'YOUR_CLIENT_ID_HERE';
        $client_secret = 'YOUR_SECRET_HERE';
        $redirect_uri = base_url().'user_authentication';
        $simple_api_key = 'YOUR_SIMPLE_API_KEY_HERE';

// Create Client Request to access Google API
        $client = new Google_Client();
        $client->setApplicationName("YOUR_APP_NAME_HERE");
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->setDeveloperKey($simple_api_key);
        $client->addScope(['profile', 'email']);

// Send Client Request
        $objOAuthService = new Google_Service_Oauth2($client);

// Add Access Token to Session
        if (isset($_GET['code'])) {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }

// Set Access Token to make Request
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
        }

// Get User Data from Google and store them in $data
        if ($client->getAccessToken()) {
            $userData = $objOAuthService->userinfo->get();
            $data['userData'] = $userData;
            $_SESSION['access_token'] = $client->getAccessToken();

            // Set email in session
            $this->session->set_userdata(['email' => $userData->email]);
            $this->session->set_userdata(['name' => $userData->name]);

            // Add email to User db if non-existent
            $this->add_user($userData);

            $this->load->model('user');

            // Set privilege level and user picture location
            $user = $this->user->get_user($userData->email);
            $level = $user->level;
            $picture = $user->picture;
            $givenName = $user->givenName;

            // Create and set period
            $this->load->model('period');
            $this->period->create_active(); // if no active exists
            $active_period = $this->period->get_active();

            // Set corresponding session variables
            $this->session->set_userdata(['level' => $level]);
            $this->session->set_userdata(['picture' => $picture]);
            $this->session->set_userdata(['givenName' => $givenName]);
            $this->session->set_userdata(['period_id' => $active_period->id]);
        } else {
            $authUrl = $client->createAuthUrl();
            $data['authUrl'] = $authUrl;
        }

        // Load view and send values stored in $data
        if (isset($userData)) {
            // Loads if user is logged in
            redirect(base_url() . "home");
        } else {
            // Loads if user is logged out
            redirect($authUrl);
        }
    }

// Unset session and logout
    public function logout() {
        unset($_SESSION['access_token']);
        unset($_SESSION['email']);
        unset($_SESSION['picture']);
        unset($_SESSION['name']);
        $this->session->set_userdata(['level' => 0]);
        redirect(base_url());
    }

    /**
     * Creates a user with the data provided and inserts it into the user
     * table if pk does not exist in user table.
     * @param array $userData
     */
    public function add_user($userData) {

        $this->load->model('user');

        $userObj = new User();
        $userObj->email = $userData->email;
        $userObj->id = $userData->id;
        $userObj->familyName = $userData->familyName;
        $userObj->givenName = $userData->givenName;
        $userObj->name = $userData->name;
        $userObj->gender = $userData->gender;
        $userObj->locale = $userData->locale;
        $userObj->picture = $userData->picture;
        $userObj->level = 1;

        $this->user->add($userObj);
    }

}
