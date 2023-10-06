<?php
    function validateDate($date, $format = 'Y-m-d') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    function validate($get) {
        $error = [];
        !empty($get['material'])
            ? !empty($get['date_start'])
                ? validateDate($get['date_start'])
                    ? !empty($get['date_end'])
                        ? validateDate($get['date_end'])
                            ? (date('Y-m-d',strtotime($get['date_start'])) < date('Y-m-d',strtotime($get['date_end'])))
                                ?
                                : $error = 'конечная дата должна быть больше начальной'
                            : $error = 'неверный формат конечной даты'
                        : $error = 'введите конечную дату'
                    : $error = 'неверный формат начальной даты'
                : $error = 'введите начальную дату'
            : $error = 'введите материал';
        return $error;
    }