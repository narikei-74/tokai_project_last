<?php

return [
    'custom' => [
        'user_id' => [
            'required' => '必ず入力してください。',
            'string' => '使用できない文字が含まれています。',
            'max' => '255文字以内で設定してください。',
            'unique' => 'すでに使われているユーザーIDです。',
        ],

        'password' => [
            'required' => '必ず入力してください。',
            'string' => '使用できない文字が含まれています。',
            'confirmed' => '確認用パスワードと一致していません。',
            'min' => '8文字以上で設定してください。'
        ],

        'keywords' => [
            'required' => '入力してください。',
        ],

        'subject' => [
            'required' => '必ず入力してください。',
        ],

        'explanation' => [
            'required' => '必ず入力してください。',
        ]
    ],
];
