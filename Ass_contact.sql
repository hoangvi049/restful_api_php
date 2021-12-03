CREATE TABLE `information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `number` varchar(20) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO `information` (`id`, `client_id`, `name`, `email`, `number`, `subject`,`message`) VALUES
(1, 5, 'Nguyen Van A', 'A@gmail.com', '0334289095', 'Is the chair A available', 'Hi, im A, i want to buy the chair A, is the chair A available?'),
(2, 4, 'Nguyen Van B', 'B@gmail.com', '0334289094', 'Is the chair B available', 'Hi, im B, i want to buy the chair B, is the chair B available?'),
(3, 3, 'Nguyen Van C', 'C@gmail.com', '0334289093', 'Is the chair C available', 'Hi, im C, i want to buy the chair C, is the chair C available?'),
(4, 2, 'Nguyen Van D', 'D@gmail.com', '0334289092', 'Is the chair D available', 'Hi, im D, i want to buy the chair D, is the chair D available?'),
(5, 1, 'Nguyen Van E', 'E@gmail.com', '0334289091', 'Is the chair E available', 'Hi, im E, i want to buy the chair E, is the chair E available?');
