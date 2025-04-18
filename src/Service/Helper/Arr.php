<?php

namespace App\Service\Helper;

class Arr
{
    /**
     * Двухмерный индексированный массив, представляющий таблицу превращаем в двухмерный ассоциативный, убирая заголовок
     *
     * [
     *  [name, id, value]               [
     *  [Sergay, 1, 2323]           =>      [name => Sergay, id => 1, value => 2323
     *  [Alex, 2, sample text]              [name => Alex, id => 2, value => sample text]
     * ]                                ]
     *
     * @param array $table
     * @return array
     */
    public static function arrayTableToAssoc(array $table): array
    {
        $headers = array_shift($table);

        return array_map(function ($row) use ($headers) {
            $assocRow = [];
            foreach ($headers as $index => $header) {
                $assocRow[$header] = $row[$index] ?? null;
            }

            return $assocRow;
        }, $table);
    }
}