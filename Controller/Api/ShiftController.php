<?php

class ShiftController extends BaseController
{
    public function createShift($data)
    {

        $strErrorDesc = '';
        $responseData = '';

        $shiftHours = (strtotime($data->end) - strtotime($data->start)) / 3600;

        if ($shiftHours > 8) {
            $responseData = "shift should not be greater than 8 hours.";
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        }

        try {
            $shiftModel = new ShiftModel();
            $start = date('Y-m-d', strtotime($data->start));
            $userid = $data->user_id;
            $checkShift = $shiftModel->checkShift($userid, $start);

            if (count($checkShift->get_result()->fetch_all(MYSQLI_ASSOC)) > 0) {
                $responseData = json_encode(["message" => "This user has an existing shift for {$start}"]);
            } else {
                $shiftModel->saveShift($userid, $data->start, $data->end);
                $responseData = json_encode(["message" => "shift created"]);
            }
        } catch (Error $e) {
            $strErrorDesc = 'error: ' . $e->getMessage();
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        // send output
        if (!$strErrorDesc) {
            return $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            return $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}
