<?php

require_once "method.php";
$obj_cake = new Cake ();
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $obj_cake->get_cake($id);
        } else {
            $obj_cake->get_cakes();
        }
        break;
        case 'POST':
            if (!empty($_GET["id"])) {
                $id = intval($_GET["id"]);
                $obj_cake->update_cake($id);
            } else {
                $obj_cake->insert_cake();
            }
            break;
            case 'DELETE':
                $id = intval($_GET["id"]);
                $obj_cake->delete_cake($id);
                break;
                default:
                header("HTTP/1.0 405 Method Not Allowed");
                break;
            }