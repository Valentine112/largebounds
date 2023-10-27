<?php
    namespace Controller;

    use mysqli;
    use Service\{
        Response,
        Func
    };
    use Model\User as ModelUser;
    use Config\Authenticate;

    class User extends Response {

        private static $db;

        public function __construct(mysqli $db) {
            self::$db  = $db;
        }

        public function main(array $data) : array {

            define("USER", Authenticate::check_user());

            $modelUser = new ModelUser(self::$db, $data, USER['content']);

            (array) $result = [];

            //if(USER['type'] === 0):

            switch($data['action']):

                case 'login':
                    $result = $modelUser->login();

                    break;

                case 'register':
                    $result = $modelUser->register();

                    break;

                case 'forgot':
                    $result = $modelUser->forgot();
                    break;

                case 'password':
                    //$result = $modelUser->password();
                    break;
                
                default:

                    break;

            endswitch;

            // else:

            if(USER['type'] === 2):
                switch($data['action']):

                    case 'purchase':
                        $result = $modelUser->purchase();
    
                        break;
                    
                    case 'create':
                        $result = $modelUser->create();

                        break;

                    case 'deposit':
                        $result = $modelUser->deposit();

                        break;

                    case 'settings':
                        $result = $modelUser->settings();

                        break;

                    case 'withdraw':
                        $result = $modelUser->withdraw();

                        break;

                    default:
    
                        break;
    
                endswitch;
            else:
                $this->type = "warning";
                $this->status = 0;
                $this->message = "fill";
                $this->content = USER['content'];
            endif;

            switch ($data['action']) {
                
                case 'admin/login':
                    $result = $modelUser->adminLogin();

                    break;

                case 'admin/users':
                    $result = $modelUser->adminUsers();

                    break;

                case 'admin/settings':
                    $result = $modelUser->adminSettings();

                    break;

                case 'admin/create':
                    $result = $modelUser->adminCreate();

                    break;

                case 'admin/action':
                    $result = $modelUser->adminAction();

                    break;
                
                default:
                    # code...
                    break;
            }

            //     $result = $this->deliver();

            // endif;

            return $result;
        }

    }
?>