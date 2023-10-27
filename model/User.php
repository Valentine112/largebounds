<?php
    namespace Model;
    use mysqli;
    use Service\{
        Response,
        Func,
        Mailing,
        Upload,
        EmailBody
    };

    use Query\{
        Delete,
        Insert,
        Select,
        Update
    };

    class User extends Response {

        private static $db;
        private $user;
        private $data;
        private $selecting;

        public function __construct(mysqli $db, array $data, int|string $user) {
            self::$db = $db;

            $this->data = $data;
            $this->selecting = new Select(self::$db);
            $this->user = $user;
        }

        public function login() : array {
            $value = $this->data['val'];

            $this->status = 0;
            $this->type = "error";
            $this->message = "void";

            $email = $value['email'];
            $password = $value['password'];

            $data = [
                'email' => $email,
                '1' => '1',
                'needle' => '*',
                'table' => 'user'
            ];

            $result = Func::searchDb(self::$db, $data, "AND");
            if($result):
                // Verify the password
                if(password_verify($password, $result['password'])):
                    $this->status = 1;
                    $this->content = "Success";

                    $_SESSION['token'] = $result['token'];
                else:
                    $this->message = "fill";
                    $this->content = "Invalid email or password";
                endif;
            else:
                $this->message = "fill";
                $this->content = "Invalid email or password";

            endif;

            return $this->deliver();
        }

        public function register() : array {
            $value = $this->data['val'];

            $this->status = 0;
            $this->type = "error";
            $this->message = "void";

            $fullname = $value['fullname'];
            $username = $value['username'];
            $email = $value['email'];
            $password = $value['password'];
            $referred = $value['referred'];

            $name = explode(" ", $fullname);
            $firstname = $name[0];
            $lastname = $name[1] ? $name[1] : "";


            // Check if username exist
            $data = [
                'username' => $username,
                '1' => '1',
                'needle' => 'token',
                'table' => 'user'
            ];

            $result = Func::searchDb(self::$db, $data, "AND");
            if(!$result):
                // Check for email
                $data = [
                    'email' => $email,
                    '1' => '1',
                    'needle' => 'token',
                    'table' => 'user'
                ];
                $result = Func::searchDb(self::$db, $data, "AND");
                if(!$result):
                    self::$db->autocommit(false);
                    // Check if password is greater than 7
                    if(strlen(trim($password)) > 6):
                        // Send email, then proceed to save user
                        $token = Func::tokenGenerator();

                        // Save the user to the database
                        $subject = [
                            "token",
                            "fname",
                            "lname",
                            "refcode",
                            "username",
                            "email",
                            "password",
                            "date"
                        ];

                        $items = [
                            $token,
                            $firstname,
                            $lastname,
                            random_int(1000, 9999).time(),
                            $username,
                            $email,
                            password_hash($password, PASSWORD_DEFAULT),
                            Func::dateFormat()
                        ];

                        $inserting = new Insert(self::$db, "user", $subject, "");
                        if($inserting->action($items, 'sssssss')):
                            self::$db->autocommit(true);
                            $mailing = new Mailing($email, $fullname, $token, Func::email_config());
                            $body = [
                                "head" => "Welcome to Casioart",
                                "elements" => "Welcome to Casioart! Explore our world of Arts. We are here provide you with the top notch Arts, so take a look around and discover. If you have any questions or need assistance, feel free to contact us on the platform. Happy browsing."
                            ];

                            $mailing->set_params((new EmailBody($data))->main(), "Registration");
                            if($mailing->send_mail()):
                                self::$db->autocommit(true);
                                $this->status = 1;
                                $this->type = "Success";
                                $this->content = "Success";
                            else:
                                $this->message = "void";
                                $this->content = "Something went wrong. . .";
                            endif;
                        else:
                            $this->message = "void";
                            $this->content = "Something went wrong. . .";
                        endif;
                    else:
                        $this->message = "fill";
                        $this->content = "Password should be greater than 7";
                    endif;
                else:
                    $this->message = "fill";
                    $this->content = "Email already exist";
                endif;

            else:
                $this->message = "fill";
                $this->content = "Useername already exist";
            endif;

            return $this->deliver();
        }

        public function forgot() : array {
            $email = $this->data['val']['email'];

            $this->status = 0;
            $this->type = "error";
            $this->message = "void";

            $forgotToken = Func::tokenGenerator();
            $forgotDate = Func::dateFormat();

            $updating = new Update(self::$db, "SET forgot = ?, forgotDate = ? WHERE email = ?# $forgotToken# $forgotDate# $email");
            if($updating->mutate('ss', "user")):
                $mailing = new Mailing($email, null, $forgotToken, Func::email_config());
                $body = [
                    "head" => "Forgot password",
                    "elements" => "We noticed that you requested a change of password from this email. If this is really you, please follow the link below to reset your password. <a href='password?token=$forgotToken'>Please follow this link</a>"
                ];

                $mailing->set_params("<h1>Hello</h1>", "Forgot");
                if($mailing->send_mail()):
                    $this->status = 1;
                    $this->type = "Success";
                    $this->content = "Check your email address for the confirmation link";

                else:
                    $this->message = "void";
                    $this->content = "Something went wrong. . .";
                endif;
            else:
                $this->message = "void";
                $this->content = "Something went wrong. . .";
            endif;

            return $this->deliver();
        }

        public function password() : array {
            $password = $this->data['val']['password'];

            $this->status = 0;
            $this->type = "error";
            $this->message = "void";

            if(strlen(trim($password)) > 6):
                // Proceed to uodate the password

            else:

            endif;

            return $this->deliver();
        }

        public function purchase() : array {
            $this->status = 0;
            $this->message = "fill";
            $this->type = "error";

            $val = $this->data['val'];
            $item = $val['item'];
            $price = $val['price'];

            // Fetch the item info
            $data = [
                "id" => $item,
                "1" => "1",
                "needle" => "*",
                "table" => "arts"
            ];

            $result = Func::searchDb(self::$db, $data, "AND");
            (float) $price = $result['price'];
            (int) $itemOwner = $result['username'];

            // Check if user has enough cash for the purchase
            $data = [
                "id" => $this->user,
                "1" => "1",
                "needle" => "*",
                "table" => "user"
            ];

            $user = Func::searchDb(self::$db, $data, "AND");
            $wallet = $user['wallet'];

            (float) $wallet = $wallet == null ? 0 : $wallet;

            if($wallet >= $price):
                self::$db->autocommit(false);
                // Save the art for the user
                $inserting = new Insert(self::$db, "collections", ["user", "art", "type", "date"], "");
                $action = $inserting->action([
                    $this->user,
                    $item,
                    "Bought",
                    Func::dateFormat()
                ], "iiss");
                if(!$action) return $action;

                // Update user balance
                $newBalance = $wallet - $price;
                $updating = new Update(self::$db, "SET wallet = ?# $newBalance");
                $action = $updating->mutate('d', 'user');
                if(!$action) return $action;

                // Update owner balance

                // Fetch item owner info
                $data = [
                    "username" => $itemOwner,
                    "1" => "1",
                    "needle" => "wallet",
                    "table" => "user"
                ];
    
                $ownerWallet = Func::searchDb(self::$db, $data, "AND");
                $ownerWallet = empty($ownerWallet) && 0;

                $newBalance = $price + $ownerWallet;
                $updating = new Update(self::$db, "SET wallet = ? WHERE username = ?# $newBalance# $itemOwner");
                $action = $updating->mutate('ds', 'user');
                if(!$action) return $action;

                // Send email
                $mailing = new Mailing($user['email'], null, null, Func::email_config());
                $body = [
                    "head" => "Purchase Transaction",
                    "elements" => [
                        "Shopper" => $user['username'],
                        "Item" => $result['name'],
                        "Price" => $result['price'],
                        "Creator" => $result['username']
                    ]
                ];
                
                $mailing->set_params("<h1>Hello</h1>", "Forgot");
                if(!$mailing->send_mail()) return $this->deliver();
                
                self::$db->autocommit(true);

                $this->status = 1;
                $this->type = "success";
                $this->content = "Item successfully purchased";
            else:
                $this->content = "Insufficient balance";
            endif;

            return $this->deliver();
        }

        public function create() : array {
            $this->status = 0;
            $this->message = "fill";
            $this->type = "error";

            $name = $this->data['name'];
            $price = $this->data['price'];

            self::$db->autocommit(false);

            // Check if user has enough to mint
            $data = [
                "id" => $this->user,
                "1" => "1",
                "needle" => "*",
                "table" => "user"
            ];

            $user = Func::searchDb(self::$db, $data, "AND");
            if($user['wallet'] >= 0.2):
                $uploading = new Upload("src/assets/collections", "../src/assets/collections", $this->data['file']);
                $res = $uploading->saveImage();

                if($res['status'] !== 1) return $res;
                // Save image path in database

                // Fetch username
                $data = [
                    "id" => $this->user,
                    "1" => "1",
                    "needle" => "username",
                    "table" => "user"
                ];

                $username = Func::searchDb(self::$db, $data, "AND");
                $token = Func::tokenGenerator();
                $inserting = new Insert(self::$db, "arts", ["token", "name", "path", "price", "username"], "");
                $action = $inserting->action([
                    $token,
                    $name,
                    $res['content'][0],
                    $price,
                    $username
                ], 'sssds');
                if(!$action) return $action;

                // Save to collections
                // Get collection Id
                $data = [
                    "token" => $token,
                    "1" => "1",
                    "needle" => "id",
                    "table" => "arts"
                ];

                $art = Func::searchDb(self::$db, $data, "AND");
                $inserting = new Insert(self::$db, "collections", ["user", "art", "type", "date"], "");
                $action = $inserting->action([
                    $this->user,
                    $art,
                    "Created",
                    Func::dateFormat()
                ], 'iiss');

                if(!$action) return $action;

                // Update user balance
                $newBalance = $user['wallet'] - 0.2;
                $updating = new Update(self::$db, "SET wallet = ? WHERE id = ?# $newBalance# $this->user");
                $action = $updating->mutate('di', 'user');
                if(!$action) return $action;

                self::$db->autocommit(true);

                $this->status = 1;
                $this->type = "success";
                $this->content = "Item successfully created";
            else:
                $this->content = "You do not have enough ETH to mint";
            endif;

            return $this->deliver();
        }

        public function deposit() : array {
            $this->status = 0;
            $this->message = "fill";
            $this->type = "error";

            // Check if user has enough to mint
            $data = [
                "id" => $this->user,
                "1" => "1",
                "needle" => "*",
                "table" => "user"
            ];

            $user = Func::searchDb(self::$db, $data, "AND");

            $amount = $this->data['amount'];
            $file = $this->data['file'];

            self::$db->autocommit(false);

            // Check if the data is fill
            if(empty($amount) || empty($file)):
                $this->content = "Please fill the forms";
            else:
                $uploading = new Upload("src/assets/deposits", "../src/assets/deposits", $file);
                $res = $uploading->saveImage();

                if($res['status'] !== 1) return $res;

                // Save to database next
                $inserting = new Insert(self::$db, "deposits", [
                    "token",
                    "user",
                    "amount",
                    "proof",
                    "date"
                ], "");

                $action = $inserting->action([
                    Func::tokenGenerator(),
                    $this->user,
                    $amount,
                    $res['content'][0],
                    Func::dateFormat()
                ], 'sidss');

                if(!$action) return $action;


                // Notify the user via email
                $data = [
                    "head" => "Deposit Transaction",
                    "elements" => [
                        "Amount" => $amount,
                        "User" => $user['username'],
                        "Method" => "Ethereum",
                        "Date" => date("Y-m-d")
                    ]
                ];

                // Send an email address
                $mailing = new Mailing($user['email'], $user['fullname'], null, Func::email_config());
                $mailing->set_params("<h1>Hello</h1>", "Deposit");
                if($mailing->send_mail()):
                    self::$db->autocommit(true);

                    $this->status = 1;
                    $this->type = "success";
                    $this->content = "Deposit awaiting confirmation";
                else:
                    $this->content = "Something went wrong. . .";
                endif;

            endif;

            return $this->deliver();
        }

        public function withdraw() : array {
            $this->status = 0;
            $this->message = "fill";
            $this->type = "error";

            $amount = $this->data['val']['amount'];
            $address = $this->data['val']['address'];

            // Check if user has enough to mint
            $data = [
                "id" => $this->user,
                "1" => "1",
                "needle" => "*",
                "table" => "user"
            ];

            $user = Func::searchDb(self::$db, $data, "AND");
            $userWallet = $user['wallet'] === null ? 0 : $user['wallet'];

            if(empty($user)) return $user;

            // Check if user has enough money in his wallet
            if($amount < $userWallet):
                // Check if user wallet is above the min withdrawal
                if($userWallet >= 1.5):
                    self::$db->autocommit(false);
                    // Proceed to insert a new record and debit from user wallet
                    $inserting = new Insert(self::$db, "withdraw", [
                        "token",
                        "user",
                        "amount",
                        "address",
                        "status",
                        "date"
                    ], "");
                    $action = $inserting->action([
                        Func::tokenGenerator(),
                        $this->user,
                        $amount,
                        $address,
                        0,
                        Func::dateFormat()
                    ], "sidis");

                    if(!$action) return $action;

                    // Debit user
                    $newBalance = $userWallet - $amount;

                    $updating = new Update(self::$db, "SET wallet = ? WHERE id = ?# $newBalance# $this->user");
                    $action = $updating->mutate('di', 'user');
                    if(!$action) return $action;

                    // Notify the user via email
                    $data = [
                        "head" => "Withdrawal Transaction",
                        "elements" => [
                            "Amount" => $amount,
                            "Address" => $address,
                            "Wallet Name" => "Ethereum",
                            "Date" => date("Y-m-d")
                        ]
                    ];

                    $mailing = new Mailing($user['email'], $user['fullname'], null, Func::email_config());
                    $mailing->set_params("", "Withdrawal");
                    if($mailing->send_mail()):
                        self::$db->autocommit(true);
                        $this->status = 1;
                        $this->content = "Withdrawal sent for confirmation";
                    else:
                        $this->content = "Something went wrong. . .";
                    endif;
                else:
                    $this->content = "Minimum withdrawal is 1.5 ETH";
                endif;
            else:
                $this->content = "Insufficient balance";
            endif;


            return $this->deliver();
        }

        public function settings() : array {
            $this->status = 0;
            $this->message = "fill";
            $this->type = "error";

            $val = $this->data['val'];
            $email = $val['email'];
            $nPassword = $val['nPassword'];
            $cPassword = $val['cPassword'];

            // Check if user has enough to mint
            $data = [
                "id" => $this->user,
                "1" => "1",
                "needle" => "*",
                "table" => "user"
            ];

            $user = Func::searchDb(self::$db, $data, "AND");
            if(password_verify($cPassword, $user['password'])):

                $emailNew = empty($email) ? $user['email'] : $email;
                $passwordNew = empty($nPassword) ? $user['password'] : password_hash($nPassword, PASSWORD_DEFAULT);

                // Verify email and password
                if(!empty($nPassword)):
                    if(strlen(trim($nPassword)) < 7):
                        $this->content = "Password should be 7 characters and above";
                        return $this->deliver();
                    endif;
                endif;

                $updating = new Update(self::$db, "SET email = ?, password = ? WHERE id = ?# $emailNew# $passwordNew# $this->user");
                $action = $updating->mutate('ssi', 'user');
                if(!$action) return $action;

                $this->status = 1;
                $this->type = "success";
                $this->content = "Successfully updated profile";
                
            else:
                $this->content = "Confirmation password is incorrect";
            endif;

            return $this->deliver();
        }

        public function adminLogin() : array {
            $this->status = 0;
            $this->message = "fill";
            $this->type = "error";

            $val = $this->data['val'];
            $username = $val['username'];
            $pass = $val['password'];

            // Check if username exists
            $data = [
                "username" => $username,
                "1" => "1",
                "needle" => "password",
                "table" => "admin"
            ];

            $hashed = Func::searchDb(self::$db, $data, "AND");
            if($hashed):
                // Confirm password
                password_verify($pass, $hashed) && $this->status = 1;
                $this->status === 1 && $_SESSION['admin'] = $username;
            else:
                $this->content = "Invalid credentials";
            endif;

            return $this->deliver();
        }

        public function adminSettings() : array {
            $this->status = 0;
            $this->message = "fill";
            $this->type = "error";
            $this->content = "Old password incorrect";
            
            $val = $this->data['val'];
            $oPassword = $val['oPassword'];
            $nPassword = $val['nPassword'];

            // Check if old password is correct
            $username = $_SESSION['admin'];
            $data = [
                "username" => $username,
                "1" => "1",
                "needle" => "password",
                "table" => "admin"
            ];

            $hashed = Func::searchDb(self::$db, $data, "AND");
            if(password_verify($oPassword, $hashed)):
                // Proceed to change the password
                $newHashed = password_hash($nPassword, PASSWORD_DEFAULT);
                $updating = new Update(self::$db, "SET password = ? WHERE username = ?# $newHashed# $username");
                $action = $updating->mutate('ss', 'admin');

                if(!$action) return $action;

                $this->status = 1;
            endif;

            return $this->deliver();
        }

        public function adminUsers() : array {
            $this->status = 0;
            $this->message = "fill";
            $this->type = "error";

            $user = $this->data['val']['user'];
            $wallet = $this->data['val']['wallet'];

            // Update user wallet
            $updating = new Update(self::$db, "SET wallet = ? WHERE id = ?# $wallet# $user");
            $action = $updating->mutate('di', 'user');
            if(!$action) return $action;

            $this->status = 1;

            return $this->deliver();
        }
        public function adminCreate() : array {
            $this->status = 0;
            $this->message = "fill";
            $this->type = "error";

            $name = $this->data['name'];
            $price = $this->data['price'];
            $username = $this->data['username'];

            self::$db->autocommit(false);

            $uploading = new Upload("src/assets/collections", "../src/assets/collections", $this->data['file']);
            $res = $uploading->saveImage();

            if($res['status'] !== 1) return $res;
            // Save image path in database

            $token = Func::tokenGenerator();
            $inserting = new Insert(self::$db, "arts", ["token", "name", "path", "price", "username"], "");
            $action = $inserting->action([
                $token,
                $name,
                $res['content'][0],
                $price,
                $username
            ], 'sssds');
            if(!$action) return $action;

            self::$db->autocommit(true);

            $this->status = 1;
            $this->type = "success";
            $this->content = "Item successfully created";

            return $this->deliver();
        }

        public function adminAction() : array {
            $this->status = 0;
            $this->message = "fill";
            $this->type = "error";

            $val = $this->data['val'];
            $elementId = $val['id'];
            (string) $table = "";
            (int) $type = 0;
            (string) $subject = "";

            // Update the user balance
            $data = [
                "id" => $this->user,
                "1" => "1",
                "needle" => "*",
                "table" => "user"
            ];
        
            $user = Func::searchDb(self::$db, $data, "AND");
            $user['wallet'] = $user['wallet'] == "" ? 0 : $user['wallet'];

            switch ($val['type']):
                case 'dAccept':
                    $table = "deposits";
                    $type = 1;
                    $subject = "Deposit Confirmed";

                    break;

                case 'dReject':
                    $table = "deposits";
                    $type = 0;
                    $subject = "Deposit Confirmed";

                    break;

                case 'wAccept':
                    $table = "withdraw";
                    $type = 1;
                    $subject = "Withdrawal Confirmed";
                    
                    break;

                case 'wReject':
                    $table = "withdraw";
                    $type = 0;
                    $subject = "Withdrawal Confirmed";

                    break;
                
                default:
                    # code...
                    break;

            endswitch;

            // Fetch the user id and amount requested
            $data = [
                "id" => $elementId,
                "1" => "1",
                "needle" => "*",
                "table" => $table
            ];

            $res = Func::searchDb(self::$db, $data, "AND");

            $userId = $res['user'];
            $amount = $res['amount'];

            // Checking the status to prevent multiple transaction
            if($res['status'] === 0):
                if($type === 1):
                    $updating = new Update(self::$db, "SET status = ? WHERE id = ?# $type# $elementId");
                    $action = $updating->mutate('ii', $table);
                    if(!$action) return $action;

                    // Update the user balance if its a deposit
                    if($val['type'] === "dAccept"):
                        $totalBalance = $user['wallet'] + $amount;
                        $updating = new Update(self::$db, "SET wallet = ? WHERE id = ?# $totalBalance# $userId");
                        $action = $updating->mutate('di', 'user');
                        if(!$action) return $action;
                    endif;


                    // Notify the user via email
                    if($val['type'] === "dAccept" || $val['type'] === "dReject"):
                        $data = [
                            "head" => "Deposit Confirmed",
                            "elements" => [
                                "Amount" => $amount,
                                "User" => $user['username'],
                                "Method" => "Ethereum",
                                "Date" => date("Y-m-d")
                            ]
                        ];
                    else:
                        // Fetch withdrawal address
                        $d = [
                            "id" => $elementId,
                            "1" => "1",
                            "needle" => "address",
                            "table" => "withdraw"
                        ];
                        $address = Func::searchDb(self::$db, $data, "AND");
                        
                        $data = [
                            "head" => "Withdrawal Confirmed",
                            "elements" => [
                                "Amount" => $amount,
                                "Address" => $address,
                                "Wallet Name" => "Ethereum",
                                "Date" => date("Y-m-d")
                            ]
                        ];
                    endif;

                    $mailing = new Mailing($user['email'], $user['fullname'], null, Func::email_config());
                    $mailing->set_params((new EmailBody($data))->main(), $subject);
                    if($mailing->send_mail()) self::$db->autocommit(true);
                endif;
            endif;

            if($type === 0):
                // Delete the transaction
                self::$db->autocommit(false);
                $deleting = new Delete(self::$db, "WHERE id = ?, $elementId");
                $action = $deleting->proceed($table);
                if(!$action) return $action;

                $totalBalance = $user['wallet'] + $amount;

                if($val['type'] === "wReject"):
                    $updating = new Update(self::$db, "SET wallet = ? WHERE id = ?# $totalBalance# $userId");
                    $action = $updating->mutate('di', 'user');
                    if(!$action) return $action;
                endif;

                self::$db->autocommit(true);

            endif;

            $this->status = 1;
            $this->type = "success";
            $this->content = "Transaction approved";

            return $this->deliver();
        }

    }
