SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE products (
  id int(11) NOT NULL,
  title varchar(255) NOT NULL,
  content varchar(2048) NOT NULL,
  rating float NOT NULL,
  price float NOT NULL,
  image varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO products (id, title, content, rating, price, image) VALUES
(5, 'Wasdroger3000', 'Droogt de was goed. Wast de was droger dan toen de was in de winkel was.', 3.5, 500, 'https://images.ctfassets.net/gtq5kcq8pjem/65pcZKuHDqSlS76Q90Qw2U/973124efa30fd55090c7d2d65355af78/1_2x.jpg?w=450&h=450'),
(6, 'Wasdroger4000', 'Nieuwere versie van de Wasdroger3000. Droogt de was nu 110% beter dan vorige versies.', 4, 800, 'https://images.ctfassets.net/gtq5kcq8pjem/65pcZKuHDqSlS76Q90Qw2U/973124efa30fd55090c7d2d65355af78/1_2x.jpg?w=450&h=450'),
(7, 'Kapotte wasdroger', 'Deze wasdroger is defect. Als je niet te veel wil uitgeven en zelf wil kijken of je een wasdroger kan repareren dan is dit product een uitstekende keus.', 0.5, 10, 'https://images.ctfassets.net/gtq5kcq8pjem/65pcZKuHDqSlS76Q90Qw2U/973124efa30fd55090c7d2d65355af78/1_2x.jpg?w=450&h=450'),
(8, 'Droog-oven', 'De droog-oven is een wasdroger dat ook als een oven kan functioneren. Perfect voor als je van droge was én van koken houdt!', 4, 400, 'https://images.ctfassets.net/gtq5kcq8pjem/65pcZKuHDqSlS76Q90Qw2U/973124efa30fd55090c7d2d65355af78/1_2x.jpg?w=450&h=450');

ALTER TABLE products
  ADD PRIMARY KEY (id);

ALTER TABLE products
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

