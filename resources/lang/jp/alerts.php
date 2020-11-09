<?php

return [
    'general' => [
        'success' => [
            'created' => '登録完了しました。',
            'deleted' => '削除完了しました。',
            'updated' => '更新完了しました。',
            'restore' => '復活完了しました。',
            'leave' => '退会完了しました。',
            'send_point' => 'ポイント付与完了しました。'
        ],
        'errors' => [
            'created' => '作成に失敗しました。',
            'deleted' => '更新失敗。',
            'updated' => '更新失敗。',
        ],
        'confirm' => [
            'delete' => 'よろしいですか？',
            'send_point' => 'ポイントを付与します。よろしいでしょうか？'
        ]
    ],
    'categories' => [
        'errors' => [
            'name-required' => '名前を入力していません',
            'description-required' => '説明を入力していません',
            'name-max-255' => '入力した名前は255文字を超えています',
            'description-max-255' => '入力した説明が255文字を超えています',
            'code-required' => 'コードを入力していません',
            'code-max-20' => '入力したコードが20文字を超えています',
        ]
    ],
    'offers' => [
        'errors' => [
            'desired-option-required' => 'ご希望日時を入力してください。',
            'desired-content-required' => 'ご希望待ち合わせ場所を入力してください。',
            'point_enough' => 'ポイントが足りません。'
        ]
    ],
    'upload' => [
        'accept_extension_video' => '動画ファイル形式には、mp4やmkvやaviタイプのファイルを指定してください。',
        'accept_extension_image' => '画像ファイル形式には、jpegやjpgやpngやgifタイプのファイルを指定してください。'
    ]
];
