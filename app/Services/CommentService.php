<?php

namespace App\Services;


class CommentService
{

    public function prepareData(array $data): array
    {
        $data['name'] = strip_tags($data['name']);
        $data['body'] = strip_tags($data['body']);
        return $data;
    }

}
