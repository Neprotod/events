
-- Администраторы

CREATE TABLE admins (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Пользователя',
  login varchar(60) NOT NULL COMMENT 'Мобильный телефон',
  email varchar(60) NOT NULL COMMENT 'Email адрес',
  password varchar(100) NOT NULL COMMENT 'Пароль',
  remember_token varchar(100) NULL COMMENT 'remember_token',
  PRIMARY KEY (id),
  CONSTRAINT ukLogin UNIQUE KEY (login),
  CONSTRAINT ukEmail UNIQUE KEY (email)
) ENGINE=InnoDB;

-- Пользователи

CREATE TABLE users (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Пользователя',
  mob_phone varchar(60) NOT NULL COMMENT 'Мобильный телефон',
  password varchar(100) NOT NULL COMMENT 'Пароль',
  email varchar(60) NOT NULL COMMENT 'Email адрес',
  full_name varchar(60) NOT NULL COMMENT 'ФИО',
  hobby varchar(160) NOT NULL COMMENT 'Хобби',
  birthday date NOT NULL COMMENT 'День рождения',
  registered timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Время регистрации',
  remember_token varchar(100) NULL COMMENT 'remember_token',
  PRIMARY KEY (id),
  CONSTRAINT ukEmail UNIQUE KEY (email)
) ENGINE=InnoDB;

-- Действия пользователей

CREATE TABLE logs_action (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  action varchar(30) NOT NULL COMMENT 'Техническое имя',
  description varchar(60) NOT NULL COMMENT 'Описание',
  PRIMARY KEY (id),
  CONSTRAINT ukAction UNIQUE KEY (action)
) ENGINE=InnoDB;


-- Логи

CREATE TABLE logs (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  logs_action_id int(10) UNSIGNED NOT NULL COMMENT 'ID события',
  admins_id int(10) UNSIGNED DEFAULT NULL COMMENT 'id администратора, если поле пустое, значит событие делал пользователь.',
  users_id int(10) UNSIGNED NOT NULL COMMENT 'id пользователя, который или над которым происходит изменение.',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Время создания',
  old_value text COLLATE utf8mb4_unicode_ci COMMENT 'Старые значения',
  new_value text COLLATE utf8mb4_unicode_ci COMMENT 'Новые значения',
  PRIMARY KEY (id),
  INDEX ixAdminsId (admins_id),
    CONSTRAINT fkLogsAdminId FOREIGN KEY (admins_id)
      REFERENCES admins (id) ON DELETE CASCADE,
  INDEX ixUsersId (users_id),
    CONSTRAINT fkLogsUsersId FOREIGN KEY (users_id)
      REFERENCES users (id) ON DELETE CASCADE,
  INDEX ixLogsActionId (logs_action_id),
    CONSTRAINT fkLogsActionId FOREIGN KEY (logs_action_id)
      REFERENCES logs_action (id) ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE messages (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID сообщения',
  parent_id int(10) UNSIGNED DEFAULT NULL COMMENT 'ID родителя',
  user_id int(10) UNSIGNED DEFAULT NULL COMMENT 'ID пользователя',
  create_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Время создания',
  modify_time datetime DEFAULT NULL COMMENT 'Время изменения',
  message text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Сообщение',
  PRIMARY KEY (id),
  INDEX ixParentId (parent_id),
    CONSTRAINT fkMessagesParentId FOREIGN KEY (parent_id)
      REFERENCES messages (id) ON DELETE CASCADE,
  INDEX ixUserId (user_id),
    CONSTRAINT fkMessagesUsersId FOREIGN KEY (user_id)
      REFERENCES users (id) ON DELETE CASCADE
) ENGINE=InnoDB;
