<?php

declare(strict_types=1);
require './inc/bootstrap.php';
require './Controller/Api/ShiftController.php';

use PHPUnit\Framework\TestCase;

final class ShiftControllerTest extends TestCase
{
    private $data;

    public function setUp(): void
    {
        $this->data = [
            "user_id" => 4,
            "start" => "2022-12-21 00:00:00",
            "end" => "2022-12-21 08:00:00"
        ];
    }

    public function testCreateShift(): void
    {
        $shiftController = new ShiftController();
        $data = (object) $this->data;
        $response = $shiftController->createShift($data);
        $this->assertIsString($response);
        $this->assertJsonStringEqualsJsonString(json_encode(["message" => "shift created"]), $response);
    }
}
