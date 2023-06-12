<?php

declare(strict_types=1);
use Html\WebPage;
use Entity\Actor;
use Entity\Cast;
use Entity\Movie;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;

if (!isset($_GET['movieId']) or !ctype_digit($_GET['movieId'])) {
    header("Location: index.php");
    exit();
} else {
    $movieId = $_GET['movieId'];
}

try {
    $myMovie = Movie::findById($movieId);
    $html = new WebPage();
    $html->setTitle($myMovie->getTitle());
    $html->appendContent("<header><h1>{$myMovie->getTitle()}</h1>\n");

} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
