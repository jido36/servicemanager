<?php
require __DIR__ . "/inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/Controller/Api/ShiftController.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $uri[1] === "new_shift") {
    // echo "create new shift";
    $strErrorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    // $arrQueryStringParams = $this->getQueryStringParams();

    if (strtoupper($requestMethod) == 'POST') {
        $shiftData = json_decode(file_get_contents('php://input'));
        $shiftController = new ShiftController();
        $shiftController->createShift($shiftData);
    } else {
        $strErrorDesc = 'Method not supported';
        $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';

        $shiftController->sendOutput(
            json_encode(array('error' => $strErrorDesc)),
            array('Content-Type: application/json', $strErrorHeader)
        );
    }


    // $start = ($shiftData->start);
    // echo date('Y-m-d', strtotime($start));
} else {
    echo "page not found";
}
