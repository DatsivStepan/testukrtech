<h1>Тестовое задание для Ukrtech.Info</h1>

<h3 align="center">Инструкция по использованию</h3>
<p>
    если установлен git
    запустить команду
    git clone https://github.com/DatsivStepan/testukrtech.git
</p>

<p>При использовании <b>BinarTask1</b> или <b>BinarTask2</b>, прописать подключение в MySQL в соответствующих файлах, база даних, и таблица создаются автоматически</p>
<code>
    $this->db = new db();
</code>
<p>если настройки, отличаються от</p>
<code>
    ....($dbhost = 'localhost', $dbuser = 'root', $dbpass = ''.....
</code>

<p>перед запуском, файла index.php, розкоментировать и внести необходимие параметри(по необходимости)</p>

<h4><b>Условие 1.</b></h4>
<code>
    //Реализовать класс для построения бинара. Он должен принимать parent_id и position
    $model = new BinarTask1;
    $model->parentId = 1; //parent_id - узел должен существовать
    $model->position = BinarTask1::POSITION_RIGTH;
    echo $model->save(); //Вывод состояния
</code>

<h4><b>Условие 2.</b></h4>
<code>
    $model = new BinarTask2;
    //Класс будет автоматически заполнять бинар до 5 уровня
    echo $model->autoCreate(); //принимает два параметра 1 - id елемента с котрого надо начать заполнять(по умолчанию 1), 2- количество уровней(по умолчанию 2)
    //возвращений результата true|false

    //Также класс должен дать возможность получить по id ячейки все нижестоящие 
    var_dump($model->getNextElements(4)); //возвращает масив елементов нижестоящих

    //и вышестоящие ячейки.
    var_dump($model->getPreElements(1)); //возвращает масив елементов вишестоящих
</code>

<h3 align="center">Тестовое задание</h3>
<p>
    Реализация классов для работы с бинаром. Предварительно создать таблицу для
    хранения ячеек бинара. Изначально в корне бинара нужно поставить ячейку, от которой
    будет построение дальнейшего дерева.
</p>
<table>
    <tr>
        <td>id</td>
        <td>int(11)</td>
        <td>идентификатор ячейки</td>
    </tr>
    <tr>
        <td>parent_id</td>
        <td>int(11)</td>
        <td>идентификатор родителя</td>
    </tr>
    <tr>
        <td>position</td>
        <td>int(11)</td>
        <td>позиция ячейки относительно родителя (1 ли 2), то есть слева или справа от родителя</td>
    </tr>
    <tr>
        <td>path</td>
        <td>varchar(12288)</td>
        <td>путь ячейки вида 1.3.8, где 8 это id текущей ячейки, а 3 и
                1 - это родители ячейки снизу вверх.
                https://gist.github.com/codedokode/10539720#4-materialized-path
        </td>
    </tr>
    <tr>
        <td>level</td>
        <td>int(11)</td>
        <td>уровень бинара, начиная от 1</td>
    </tr>
</table>
<p>
    <b>Условие 1.</b> Реализовать класс для построения бинара. Он должен принимать
    parent_id и position для создания ячейки, остальные данные должен формировать
    автоматически.
</p>

<p>
    <b>Условие 2.</b> Реализовать отдельно класс для управления бинаром. Класс будет
    автоматически заполнять бинар до 5 уровня, включительно, слева направо, сверху вниз.
    Также класс должен дать возможность получить по id ячейки все нижестоящие и
    вышестоящие ячейки.
</p>
