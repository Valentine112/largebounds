<?php
    namespace service;

    class EmailBody {
        private array $data;
        function __construct(array $data)
        {
            $this->data = $data;
        }
        public function main() : string {
            $head = $this->data['head'];
            return '
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <style>
                        .container{
                            background-color: #000;
                        }
                        .main{
                            width: 100%;
                            text-align: center;
                            color: #fff;
                            font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;
                            background-color: #2BBC85;
                            padding: 20px 0;
                        }
                        .container .content{
                            width: 60%;
                            text-align: center;
                            color: #fff;
                            margin: auto;
                            font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
                            padding: 20px 0;
                        }
                        .container footer{
                            padding: 20px 1px;
                            background-color: #444;
                            color: #c1c1c1;
                            text-align: center;
                            font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
                            font-size: 14px;
                        }
                        footer .footer-content{
                            margin: auto;
                        }
                        .content span{
                            line-height: 40px;
                        }
                        .content ul{
                            list-style: none;
                            padding-inline-start: 0;
                        }
                        .content ul li{
                            margin: 20px 0;
                        }
                        @media screen and (min-width: 992px) {
                            .container .content{
                                width: 45%;
                            }
                            footer .footer-content{
                                width: 60%;
                            }
                        }
                    </style>
                </head>
                <body>
                <div class="container">
                    <div>
                        <div class="main">
                            <h2>'.$head.'</h2>
                        </div>
                        <div class="content">
                            '.$this->checkContent().'
                        </div>

                        <footer>
                            <div class="footer-content">
                                <span>Copyright &#169; 2023 Casioart Marketplace</span>
                                <p>Casioart NFT (Non-Fungible Token) company at the forefront of the digital art revolution. Founded in [Year], our mission is to bridge the gap between artists and the blockchain, providing a platform for creators to tokenize their artwork, engage with a global audience, and monetize their digital talents like never before</p>
                            </div>
                        </footer>
                    </div>
                </div>
            </body>
            </html>';
        }

        private function checkContent() {
            if(is_string($this->data['elements'])) return $this->data['elemtents'];

            if(is_array($this->data['elements'])):
                return "<ul>".$this->displayList()."</ul>";
            endif;
        }

        private function displayList() {
            foreach(array_keys($this->data['elements']) as $elem):
                $val = $this->data['elements'][$elem];

                return '<li>'.$elem.': &ensp; '.$val.'</li>';
            endforeach;
        }
    
    }
?>