<?php

return [
    'reset_password' => [
        'subject' => 'パスワードリセットのお知らせ',
        'content' => [
            'url' => '下記のURLにアクセスし、パスワード再設定手続きへお進みください。',
            'time_expired' => '*3時間以内に更新の手続きが完了しない場合、上記URLは無効となります。',
            'text' => '本メールにお心当たりがない場合は、お手数ですが破棄してくださいますようお願いいたします。'
        ]
    ]
];
