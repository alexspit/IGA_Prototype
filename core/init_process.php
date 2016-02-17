<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/17/2016
 * Time: 1:37 PM
 */

//Allow user to set sessions
if (session_status() == PHP_SESSION_NONE)
{
    session_start();

}

require_once '../vendor/autoload.php';
//Autoloading classes instead of using require once every time. Only load classes used.
//Pass a function that runs everytime a class is accessed
spl_autoload_register(function($class){
    //echo 'IGA_Prototype/classes/'. $class .'.php';


    require_once '../classes/'. $class .'.php';


});

require_once "../functions/sanitize.php";

//Require functions
//require_once '/IGA_Prototype/functions/sanitize.php';


//Setting global configuration settings to be used by the config class
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'igaDB'
    ),
    'session' => array(
        'token_name' => 'token'
    )
);

function rangeWithPrefix($start, $end, $step, $prefix){

    $range = range($start, $end, $step);
    foreach ($range as &$r) {
        $r .= $prefix;
    }

    return $range;
}
/*
$GLOBALS['interface'] = [
    "logo"          =>  [
        "#logo h1"   =>  [
            "color"             =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"],
            "text-align"        =>  ["center", "left", "right"],
            "text-decoration"   =>  ["overline", "underline", "line-through", "none"],
            "font-family"       =>  ["Tangerine", "Inconsolata", "Droid Sans", "Times New Roman", "Arial", "Calibri", "Helvetica"],
            "font-style"        =>  ["normal", "italic", "oblique"],
            "font-weight"       =>  ["normal", "lighter", "bold"],
            "letter-spacing"    =>  ["-3px", "-2px", "-1px", "0px", "1px", "2px", "3px"]
        ]
    ],
    "body"          =>  [
        "body"      =>  [
            "background-color"  =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"],
            "font-family"       =>  ["Tangerine", "Inconsolata", "Droid Sans", "Times New Roman", "Arial", "Calibri", "Helvetica"]
        ]
    ],
    "banner"        =>  [
        "#banner"   =>  [
            "height"            =>  rangeWithPrefix(150, 400, 25, "px")
        ]
    ],
    "top-nav"       =>  [
        "#top_nav"  =>  [
            "background-color"  =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"],
            "position"          =>  []
        ],
        ".navbar-inverse .navbar-nav > li > a"  =>  [
            "color"             =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"]
        ],
        "#top_nav input[type='search']" =>  [
            "width"             => rangeWithPrefix(150, 450, 25, "px")
        ]
    ],
    "category-nav"  =>  [
        ".nav-pills > li > a"   =>  [
            "color"             =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"],
            "border-radius"     =>  rangeWithPrefix(0, 8, 1, "px"),
            "background-color"  =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"],
            "margin-bottom"     =>  rangeWithPrefix(0, 10, 1, "px"),
            "position"          =>  []
        ],
        ".nav-pills > li.active > a"    =>  [
            "color"             =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"],
            "background-color"  =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"]
        ]
    ],
    "products"      =>  [
        ".thumbnail"    =>  [
            "border-radius"     =>  rangeWithPrefix(0, 8, 1, "px"),
            "background-color"  =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"]
        ],
        ".thumbnail a"  =>  [
            "color"             =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"],
            "font-family"       =>  ["Tangerine", "Inconsolata", "Droid Sans", "Times New Roman", "Arial", "Calibri", "Helvetica"]
        ],
        ".thumbnail p"  =>  [
            "color"             =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"]
        ],
        ".thumbnail button" =>  [
            "border-radius"     =>  rangeWithPrefix(0, 8, 1, "px"),
            "color"             =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"],
            "background-color"  =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"]
        ]
    ],
    "footer"        =>  [
        "#footer"       =>  [
            "background-color"  =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"]
        ],
        "#footer a, #footer h4"     =>  [
            "color"             =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"],
        ],
        "footer"        =>  [
            "position"          =>  []
        ]
    ]
];

$GLOBALS['interface'] = [
    "logo"          =>  [
        "#logo h1"   =>  [
            "color"             =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"],
            "text-align"        =>  ["center", "left", "right"],
            "font-family"       =>  ["Tangerine", "Inconsolata", "Droid Sans", "Times New Roman", "Arial", "Calibri", "Helvetica"],
            "font-style"        =>  ["normal", "italic", "oblique"],
            "font-weight"       =>  ["normal", "lighter", "bold"],
            "letter-spacing"    =>  ["-3px", "-2px", "-1px", "0px", "1px", "2px", "3px"]
        ]
    ],
    "body"          =>  [
        "body"      =>  [
            "font-family"       =>  ["Tangerine", "Inconsolata", "Droid Sans", "Times New Roman", "Arial", "Calibri", "Helvetica"]
        ]
    ],
    "banner"        =>  [
        "#banner"   =>  [
            "height"            =>  rangeWithPrefix(150, 400, 25, "px")
        ]
    ],
    "top-nav"       =>  [
        "#top_nav"  =>  [
            "background-color"  =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"],
            "position"          =>  []
        ],
        ".navbar-inverse .navbar-nav > li > a"  =>  [
            "color"             =>  ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"]
        ],
        "#top_nav input[type='search']" =>  [
            "width"             => rangeWithPrefix(150, 450, 25, "px")
        ]
    ]
];*/


$fontList = ["Tangerine", "Inconsolata", "Droid Sans", "Times New Roman", "Arial", "Calibri", "Helvetica", "AbrilFatface", "Avro", "JosefinSlab", "Lato", "OldStandard", "Vollkorn", "Ubuntu", "OpenSans"];
$colorList = ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"];
$lightColorList = ["rgba(26, 188, 156, 0.25)", "rgba(59, 210, 123, 0.25)", "rgba(52, 152, 219, 0.25)", "rgba(155, 89, 182, 0.25)", "rgba(52, 73, 94, 0.25)", " rgba(241, 196, 15, 0.25)", "rgba(230, 126, 34, 0.25)", "rgba(231, 76, 60, 0.25)", "rgba(236, 240, 241, 0.25)", "rgba(149, 165, 166, 0.25)" ];

$GLOBALS['interface'] = [
    Section::HEADER =>  [
        "#logo h1"   =>  [
            "color"             =>  $colorList,
            "text-align"        =>  ["center", "left", "right"],
            "font-family"       =>  $fontList,
            "font-style"        =>  ["normal", "italic", "oblique"],
            "font-weight"       =>  ["normal", "lighter", "bold"],
            "letter-spacing"    =>  ["-3px", "-2px", "-1px", "0px", "1px", "2px", "3px"],
            "font-size"         =>  rangeWithPrefix(30,60,5, "px")
        ],
        "body"      =>  [
            "font-family"       =>  $fontList
        ],
        "#banner"   =>  [
            "height"            =>  rangeWithPrefix(150, 400, 25, "px")
        ],
        "#top_nav"  =>  [
            "background-color"  =>  $colorList
        ],
        "#top_nav_order" => [
            "order"             =>  ["nav,search,currency", "nav,currency,search", "currency,nav,search", "currency,search,nav", "search,currency,nav", "search,nav,currency" ]
        ],
        ".navbar-inverse .navbar-nav > li > a"  =>  [
            "color"             =>  $colorList
        ],
        "#top_nav input[type='search']" =>  [
            "width"             => rangeWithPrefix(150, 400, 25, "px")
        ]
    ],
    Section::BODY   =>  [
        ".nav-pills > li > a"   =>  [
            "margin-bottom"     =>  rangeWithPrefix(0, 10, 1, "px"),
            "position"          =>  ["left", "right", "top", "top-left", "top-right"]
        ],
        ".nav-pills > li.active > a"    =>  [
            "color"             =>  $colorList,
            "background-color"  =>  $colorList
        ],
        ".thumbnail"    =>  [
            "border-radius"     =>  rangeWithPrefix(0, 8, 1, "px"),
            "background-color"  =>  $lightColorList
        ],
        ".thumbnail a"  =>  [
            "color"             =>  $colorList,
            "font-family"       =>  $fontList
        ],
        ".thumbnail p"  =>  [
            "color"             =>  $colorList
        ],
        ".thumbnail button, .nav-pills > li > a" =>  [
            "border-radius"     =>  rangeWithPrefix(0, 8, 1, "px"),
            "color"             =>  $colorList,
            "background-color"  =>  $colorList
        ]
    ],
    Section::FOOTER =>  [
        "#footer"       =>  [
            "font-family"       =>  $fontList,
            "background-color"  =>  $colorList
        ],
        "#footer a"     =>  [
            "color"             =>  $colorList
        ],
        "#footer h4"    =>  [
            "font-size"         =>  rangeWithPrefix(15, 35, 5, "px"),
            "color"             =>  $colorList
        ],
        "footer"        =>  [
            "order"             =>  ["info,serv,social", "info,social,serv", "social,info,serv", "social,serv,info", "serv,social,info", "serv,info,social"]
        ],
        "#social_icons"     =>  [
            "font-size"         =>  rangeWithPrefix(25, 60, 5, "px"),
            "margin-top"        =>  rangeWithPrefix(0, 40, 5, "px")
        ],
        "#content"      =>  [
            "margin-bottom"     =>  rangeWithPrefix(10,100,10, "px")
        ]
    ]
];


//$GLOBALS['interface'] = json_decode(file_get_contents("data.json"), true);

date_default_timezone_set('Europe/Berlin');