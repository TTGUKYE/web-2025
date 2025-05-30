INSERT INTO
    users (id, username, avatar_src, about)
VALUES
    (
        1,
        'Ваня Денисов',
        '../src/images/avatar_1.jpg',
        'Привет! Я системный аналитик в ACME :) Тут моя жизнь только для самых классных!'
    ),
    (
        2,
        'Лиза Дёмина',
        '../src/images/avatar_2.jpg',
        'Я люблю путешествовать и делиться впечатлениями! Присоединяйтесь к моему миру :)'
    );

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
        'Так красиво сегодня на улице! Настоящая зима)) Вспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне, в городке, занесенном снегом по ручку двери…',
        203,
        FROM_UNIXTIME (1743554061)
    ),
    (
        2,
        2,
        '../src/images/pos.jpg',
        'Пост от Лизы - сегодня был замечательный день!',
        69,
        FROM_UNIXTIME (1743554061)
    ),
    (
        4,
        1,
        '../src/images/profile/2_building.jpg',
        'Архитектура современного мегаполиса',
        24,
        FROM_UNIXTIME (1743554061)
    ),
    (
        5,
        1,
        '../src/images/profile/3_cake.jpg',
        'Домашний десерт к чаю',
        42,
        FROM_UNIXTIME (1743554061)
    ),
    (
        6,
        1,
        '../src/images/profile/4_iSpring_team.jpg',
        'Наша команда на корпоративе',
        31,
        FROM_UNIXTIME (1743554061)
    ),
    (
        7,
        1,
        '../src/images/profile/5_coffee.jpg',
        'Утренний кофе - заряд бодрости на весь день',
        56,
        FROM_UNIXTIME (1743554061)
    ),
    (
        8,
        1,
        '../src/images/profile/6_book.jpg',
        'Новая книга для вечернего чтения',
        19,
        FROM_UNIXTIME (1743554061)
    ),
    (
        9,
        1,
        '../src/images/profile/7_gates.jpg',
        'Исторические ворота старого города',
        27,
        FROM_UNIXTIME (1743554061)
    ),
    (
        10,
        1,
        '../src/images/profile/8_brat.jpg',
        'Прогулка с братом в парке',
        33,
        FROM_UNIXTIME (1743554061)
    ),
    (
        11,
        1,
        '../src/images/profile/9_pot.jpg',
        'Новый цветок в моей коллекции',
        21,
        FROM_UNIXTIME (1743554061)
    ),
    (
        12,
        1,
        '../src/images/profile/10_Bridge.jpg',
        'Мост через реку в закатных лучах',
        48,
        FROM_UNIXTIME (1743554061)
    ),
    (
        13,
        1,
        '../src/images/profile/11_forest.jpg',
        'Лесная тропинка в осеннем лесу',
        37,
        FROM_UNIXTIME (1743554061)
    ),
    (
        14,
        1,
        '../src/images/profile/12_mountain.jpg',
        'Горные вершины в утреннем тумане',
        52,
        FROM_UNIXTIME (1743554061)
    ),
    (
        15,
        1,
        '../src/images/profile/13_telescope.jpg',
        'Астрономические наблюдения ночью',
        29,
        FROM_UNIXTIME (1743554061)
    ),
    (
        16,
        1,
        '../src/images/profile/14_burger.jpg',
        'Сочный бургер на обед',
        64,
        FROM_UNIXTIME (1743554061)
    ),
    (
        17,
        1,
        '../src/images/profile/15_flower.jpg',
        'Цветущие тюльпаны весной',
        41,
        FROM_UNIXTIME (1743554061)
    ),
    (
        18,
        2,
        '../src/images/profile/16_sunset.jpg',
        'Закат на море - незабываемое зрелище',
        58,
        FROM_UNIXTIME (1743554061)
    ),
    (
        19,
        2,
        '../src/images/profile/17_beach.jpg',
        'Отдых на пляже в тропиках',
        73,
        FROM_UNIXTIME (1743554061)
    ),
    (
        20,
        2,
        '../src/images/profile/18_city.jpg',
        'Городские огни ночью',
        45,
        FROM_UNIXTIME (1743554061)
    ),
    (
        21,
        2,
        '../src/images/profile/19_forest.jpg',
        'Прогулка по осеннему лесу',
        36,
        FROM_UNIXTIME (1743554061)
    ),
    (
        22,
        2,
        '../src/images/profile/20_mountain.jpg',
        'Восхождение на горную вершину',
        67,
        FROM_UNIXTIME (1743554061)
    ),
    (
        23,
        2,
        '../src/images/profile/21_river.jpg',
        'Река в горном ущелье',
        39,
        FROM_UNIXTIME (1743554061)
    ),
    (
        24,
        2,
        '../src/images/profile/22_lake.jpg',
        'Озеро в лесной глуши',
        43,
        FROM_UNIXTIME (1743554061)
    ),
    (
        25,
        2,
        '../src/images/profile/23_field.jpg',
        'Бескрайние пшеничные поля',
        28,
        FROM_UNIXTIME (1743554061)
    ),
    (
        26,
        2,
        '../src/images/profile/24_village.jpg',
        'Деревенский пейзаж',
        31,
        FROM_UNIXTIME (1743554061)
    ),
    (
        27,
        2,
        '../src/images/profile/25_castle.jpg',
        'Средневековый замок в горах',
        62,
        FROM_UNIXTIME (1743554061)
    );
