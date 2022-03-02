<?php

class Food {

    static public function GetFoods($base) {
        $stmt = $base->prepare("SELECT * FROM `food`");
        $stmt->execute();
        if($stmt) {
            $foodArr = [];
            while($row = $stmt->fetch()) {
                array_push($foodArr, array(
                    "id" => $row['id'],
                    "title" => $row['title'],
                    "text" => $row['text'],
                    "img_title" => $row['img_title'],
                ));
            }
            echo json_encode( $foodArr, JSON_UNESCAPED_UNICODE );
        }
    }

    static public function GetFood($base, $id) {
        $stmt = $base->prepare("SELECT * FROM `food` WHERE `id` = ?");
        $stmt->execute(array( $id ));

        if($stmt) {
            $foodArr = [];
            while($row = $stmt->fetch()) {
                array_push($foodArr, array(
                    "id" => $row['id'],
                    "title" => $row['title'],
                    "text" => $row['text'],
                    "img_title" => $row['img_title'],
                ));
            }
            echo json_encode($foodArr , JSON_UNESCAPED_UNICODE);
        }
    }

    static public function Search($base , $word) {

        $stmt = $base->prepare("SELECT * FROM `food` WHERE `title` LIKE CONCAT('%', ? , '%') ");
        $stmt->execute(array( $word ));

        if($stmt) {
            $foodArr = [];
            while($row = $stmt->fetch()) {
                array_push($foodArr, array(
                    "id" => $row['id'],
                    "title" => $row['title'],
                    "text" => $row['text'],
                    "img_title" => $row['img_title'],
                ));
            }
            echo json_encode( $foodArr, JSON_UNESCAPED_UNICODE );
        }
    }

    static public function GetFoodFilter($base) {
        //SELECT * FROM `food` ORDER BY `food`.`title` ASC
        $stmt = $base->prepare("SELECT * FROM `food` ORDER BY `food`.`title` ASC");
        $stmt->execute();
        $resArr = [];
        while($row = $stmt->fetch()) {
            array_push($resArr, $row);
        }
        echo json_encode( $resArr, JSON_UNESCAPED_UNICODE );
    }
 
}

//        $stmt = $base->prepare("SELECT * FROM `food` WHERE `title` LIKE '%?%' ");
