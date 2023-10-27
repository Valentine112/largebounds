<?php
    use Config\Database;
    use Query\Insert;
    use Query\Select;
    use Service\Func;

    $db = new Database;

    // Check if user is logged in
    if(empty($_SESSION['admin'])) header("location: ../admin");

    // ------- FETCH USERS --------- //
    $selecting = new Select($db);
    $selecting->more_details("ORDER BY id DESC");
    $action = $selecting->action("*", "user");
    if($action !== null) return $action;

    $users = $selecting->pull();

    // ---------- FETCH ARTS ---------- //
    $data = [
        "2" => "2",
        "1" => "1",
        "needle" => "COUNT(id)",
        "table" => "arts"
    ];
    $arts = Func::searchDb($db, $data, "AND");

    // ---------- FETCH TOTAL DEPOSITS ---------- //
    $data = [
        "2" => "2",
        "1" => "1",
        "needle" => "SUM(amount)",
        "table" => "deposits"
    ];
    $deposits = Func::searchDb($db, $data, "AND");
    $deposits = $deposits == "" ? 0 : $deposits;

    // ---------- FETCH CREATED ARTS ---------- //
    $data = [
        "type" => "Created",
        "1" => "1",
        "needle" => "COUNT(id)",
        "table" => "collections"
    ];
    $created = Func::searchDb($db, $data, "AND");

    // ----------- FETCH DEPOSITS ------------- //
    $selecting = new Select($db);
    $selecting->more_details("ORDER BY id DESC");
    $action = $selecting->action("*", "deposits");
    if($action !== null) return $action;

    $deposits = $selecting->pull();

    // ----------- FETCH WITHDRAWALS ------------- //
    $selecting = new Select($db);
    $selecting->more_details("ORDER BY id DESC");
    $action = $selecting->action("*", "withdraw");
    if($action !== null) return $action;

    $withdraws = $selecting->pull();


    /*$inserting = new Insert($db, "admin", ["username", "password", "date"], "");
    $action = $inserting->action(["admin@casioart.com", password_hash("casioart", PASSWORD_DEFAULT), Func::dateFormat()], 'sss');

    if(!$action) return $action;*/
?>