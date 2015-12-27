<?php
    header("Content-type: text/css; charset: UTF-8");

    require_once 'core/init.php';

    $element = new Element("h1", 1);

    $element->addProperty(new Property(1, "color", ["red", "blue", "green", "black", "white"]));
    $element->addProperty(new Property(2, "text-align", ["center", "left", "right", "justified"]));
    $element->addProperty(new Property(3, "text-decoration", ["overline", "underline", "line-through"]));
    $element->addProperty(new Property(4, "font-family", ["serif", "sans-serif", "monospace"]));
    $element->addProperty(new Property(5, "font-style", ["normal", "italic", "oblique"]));
    $element->addProperty(new Property(6, "font-weight", ["normal", "lighter", "bold"]));
    $element->addProperty(new Property(7, "letter-spacing", range(-3, 10)));

?>


h1{

    color: <?php echo $element->getProperty("color")->getRandomValue(); ?>;
    text-align: <?php echo $element->getProperty("text-align")->getRandomValue(); ?>;
    text-decoration: <?php echo $element->getProperty("text-decoration")->getRandomValue(); ?>;
    //text-transform: uppercase;
    letter-spacing: <?php echo $element->getProperty("letter-spacing")->getRandomValue(); ?>px;
    //font-size: large;
    font-style: <?php echo $element->getProperty("font-style")->getRandomValue(); ?>;
    font-weight: <?php echo $element->getProperty("font-weight")->getRandomValue(); ?>;
    background-color: <?php echo $element->getProperty("color")->getRandomValue(); ?>;

}
