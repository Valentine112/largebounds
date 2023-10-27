<?php
    namespace Src\Config;
    
    class Head {

        public static function tags() {
            $struct = substr_count($_SERVER['REQUEST_URI'], '/');

            $struct -= 1;
            $struct == 0 ? $struct = "" : $struct = str_pad("../", $struct);
            echo
            '<head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="'.$struct.'src/assets/css/general.css">
                <link rel="stylesheet" href="'.$struct.'src/config/config.css">
                <link rel="stylesheet" href="'.$struct.'src/font/fonts.css">
                <script src="'.$struct.'src/assets/js/Func.js"></script>
                <link href="'.$struct.'src/assets/css/bootstrap.min.css" rel="stylesheet">
                <link href="'.$struct.'src/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/shorthandcss@1.1.1/dist/shorthand.min.css" />
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:200,300,400,500,600,700,800,900&display=swap" />
                <link rel="stylesheet" type="text/css"
                    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
                <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
                
            </head>';
        }
    }
?>