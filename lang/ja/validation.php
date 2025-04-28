<?php

return [
    'exists' => '正しい :attribute を選択してください。',
    'max' => [
        'numeric' => ':attribute は :max 以下を入力してください。',
        'string' => ':attribute は :max 文字以内で入力してください。',
    ],
    'min' => [
        'numeric' => ':attribute は :min 以上を入力してください。',
        'string' => ':attribute は :min 文字以上を入力してください。',
    ],
    'numeric' => ':attribute は数値で入力してください。',
    'required' => ':attribute は必須入力です。',
    'unique' => ':attribute はすでに登録されています。',
    'attributes' => [
        'category_id' => 'カテゴリ',
        'title' => 'タイトル',
        'price' => '価格',
        'author_ids' => '著者',
        'author_ids.*' => '著者',
    ],
];
