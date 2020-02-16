<?php
    require('db.php');
    require('BinarTask1.php');
    require('BinarTask2.php');

//    Реализовать класс для построения бинара. Он должен принимать parent_id и position
    $model = new BinarTask1;
    $model->parentId = 1;
    $model->position = BinarTask1::POSITION_RIGTH;
    echo $model->save(); //Вывод состояния

    $model = new BinarTask2;
    //Класс будет автоматически заполнять бинар до 5 уровня
//    echo $model->autoCreate(1, 7); //принимает два параметра 1 - id елемента с котрого надо начать заполнять(по умолчанию 1), 2- количество уровней(по умолчанию 2)
    //возвращений результата true|false

    //Также класс должен дать возможность получить по id ячейки все нижестоящие 
    //var_dump($model->getNextElements(4)); //возвращает масив елементов нижестоящих

    //и вышестоящие ячейки.
    //var_dump($model->getPreElements(1)); //возвращает масив елементов вишестоящих
?>