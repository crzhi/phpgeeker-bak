<?php

return [
    'alipay' => [
        'app_id'         => '2016093000631321',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwH8zOAgA/ssIwgZi010dECzIZqXI9Q+TqM0yAGPRoRc94waX88YMsdFL4yEgMIwaSll/rdzz1UueYtGY5DlPg9kubhrePzSnOnlbA2FqbbbVWuYv0Q6pjFNtnhm9QElzRnOzikrUNwcAilH9LKhjUbdZv/yE0D4YCbAdWgK1QWe/wt7NgdqYj+bZPJXycVVz7S6YD3xP5l2MaIW6UpNjj58KLqMj8tR2ArZjM9eKPPLct0sXmd3tYKn1g7ypC661Xvn3ZAf2J50k4XDyi62vmExK0ThcFs7NAeWf7gtMmdvJf46uEY+sWN18pZGoBxuIH5qEX+IC/Zu0NPXwE5V7OwIDAQAB',
        'private_key'    => 'MIIEowIBAAKCAQEA78eY73ikkTq2BVwMkuRLVL6jJf3a9btkhOvw17Xlh5WxXtN571YpFpcfTFt8W6xm9fMXzWDoE/WOuPxH7K3itV1HA9obZAimAYZNWUQJrtwSjM/AfMORUJN8tNyd2tZQWxfMA/lNt8u11PUDY9XKKDP32abANqykiwYSjeeM9NZZeuoJPJNTk4apk3DvplYlVk22WU8twZGmaKUO4syl11guoFbWnu+VCUzDSu5wjA+4xOytWI82+zE+P5GhPyR9kFvB2DpVMC4tutK9tQgJT6rb4xVmlU1BF1yuoFw87eRbftWKD8BmXaeRX7hvKkVDthrfXMXwfEEUU4WBh2w+kQIDAQABAoIBAE4SpHZcxuDOyBOorCNsGCcox4CITrIyaQFqvYnPHURvdkhU/V/zov9LB5LaOvyyfvfYRkjGI+rTyrvq0RR8bdP14jib3M1Oj5bxft/w6mI4IAYfYyJ8nyUoULOnHfLyU0nFztUAaNDOkI8dlBP+uYsrmKkSxYVH42+s83+nBFt3imLbCe6flx4Y8KTuniR7TEuY+f+qmqJhIYKNwDj6cNA3VpEvAyz7k7UmzShSYM/Nut0PWVo5FscdIVWTXmVH3tdDRhTc7khVrv4hiIe4W3jPSrCvTQzbJT0sXh8NNevyCs9iON2P0CMUSw0152snL8VPSkebiK3NtG8v5cFojMECgYEA+na+ptR5junto6TRjDMdaTKd0BmVprrQQxcSMe5RoFjD2XfznKdyM+sBGi+XOcJrw18N9HAYdiNDTnldKFpfnNdsRhK+ivckPzvpMiwiTsiqXNBYabQdlKL9aEd5M1jT919iFTPJb1QhFPlPoAO82plLEKJ54rXQj0Bi/T5NAYkCgYEA9RRlZDv1RupnYipHlTlCfbJ+cP8REIi4P2p86V/87/0AAbOgroozppI280sqYVy3A3XxdNTOzEMS9yTQvjo4GxLEKKr4b2E3bn3yPBzhIayH4uxGzGL6NvdJPr+KJDB4n1Jv4/PLUv57rNxyU70V6fbgiTgrfbONTB177f91OskCgYBwFVOcNNlxKx49bTSZGQbAXPZiehCOXGt2mox567x7lT2PxC4wnH5u3WvQ3BtArdCrzY3hJYjM1Vr5czZNKKRA++ZoNVsvtQlzgswIt9diikoy3smyA/h427erQtDqOYYh3X13H4W1XGCxkiAf64xIBvGgsBT7b4G1mYqy6X5sgQKBgHtdSfBbkgqhYWrzd1bxHLwjBiyg6BkXiQ867ieXTr4K717r6X0SSg+V2B09f9bEkccnLmSt3m7JcJmBKaYnrihKmP0TmryOBhYTRcTmkJifvUMHxleJlwPmFDOGvOWclIs2NuZayMU9HkoUKWRncMl1oO7RnGrI394plUFm7r6pAoGBALqFd22E4zOGR2GXV/AY7uKtCV352QBhl0sdnNq88xzm1ukBHlXEBtZuOl+3vpOkRrcd3MymWJjjQ5WG77lfrnhuM5P1ROVyLGmEOMF5CMhjPOka0jaF/pujCJhb/4WI4z3bNx5bbiaVzrd7dfFoKaPmbvBBEV0L72lRZUTuxRRp',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
            'level' => 'info',            
        ],
        'mode' => 'dev', // optional,设置此参数，将进入沙箱模式

    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];