<?php


class Users {

    static public function GetComments($base, $id) {
        $stmt = $base->prepare("SELECT * FROM `commets` WHERE `idfood` = ?");
        $stmt->execute(array($id));
        if($stmt) {
            $foodArr = [];
            while($row = $stmt->fetch()) {
                array_push($foodArr, array(
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "text" => $row['text'],
                ));
            }
            echo json_encode( $foodArr, JSON_UNESCAPED_UNICODE );
        }
    }

    static public function SetComment($base, $text, $name, $id) {
        $stmt = $base->prepare("INSERT INTO `commets`(`text`, `name`, `idfood`) VALUES (?, ?, ?)");
        $stmt->execute(array($text, $name, $id));
        if($stmt) {
            self::GetComments($base, $id);
        }
    }

}