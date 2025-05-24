-- Вставка пользователей
INSERT INTO
    users (id, username, avatar_src, about)
VALUES
    (
        1,
        'Ваня Денисов',
        '../src/images/avatar_1.jpg',
        'Привет! Я системный аналитик в ACME :)'
    ),
    (
        2,
        'Лиза Дёмина',
        '../src/images/avatar_2.jpg',
        'Люблю путешествовать и делиться впечатлениями!'
    );

-- Вставка постов
INSERT INTO
    posts (
        id,
        user_id,
        image,
        description,
        like_count,
        created_at
    )
VALUES
    (
        1,
        1,
        '../src/images/streets.jpg',
        'Так красиво сегодня на улице!\nНастоящая зима))\nВспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне, в городке, занесенном снегом по ручку двери…',
        203,
        FROM_UNIXTIME (1743554061)
    ),
    (
        2,
        2,
        '../src/images/pos.jpg',
        'Пост от Лизы',
        69,
        FROM_UNIXTIME (1743554061)
    );
