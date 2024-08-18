-- >>>>>>>>>>>>>CREATE TABLE<<<<<<<<<<<<<<
CREATE TABLE `easy_blood`.`test` (
    `id` SMALLINT(5) NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(128) NOT NULL COMMENT 'Name_of_the_blood_bank' , 
    `blood_gp` INT(10) NOT NULL , 
    `last_updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) 
    ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT = 'test_table';
-- >>>>>>>>>>>>>Insert into TABLE<<<<<<<<<<<<<<
INSERT INTO `test` (`id`, `name`, `blood_gp`, `last_updated_at`) 
VALUES ('', 'Basundhara Blood Bank', '1', current_timestamp())
-- >>>>>>>>>>>>>UPDATE Row<<<<<<<<<<<<<<
UPDATE `test` 
SET `name` = 'Shondhani' 
WHERE `test`.`id` = 2

-- >>>>>>>>>>>TABLE<<<<<<<<<<<
CREATE TABLE `easy_blood`.`neg` (
    `id_NEG` SMALLINT(5) NOT NULL AUTO_INCREMENT , 
    `bbname` VARCHAR(128) NOT NULL COMMENT 'Name_of_the_blood_bank' , 
    `a` INT(16) NOT NULL ,
    `b` INT(16) NOT NULL ,
    `ab` INT(16) NOT NULL ,
    `o` INT(16) NOT NULL ,
    `last_updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id_NEG`)) 
    ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT = 'test_table';

--<<<<<<<<<<>>>>>>>>>>>>
CREATE TABLE `easy_blood`.`price` ( `id_price` SMALLINT(5) NOT NULL AUTO_INCREMENT , `bbname` VARCHAR(128) NOT NULL UNIQUE COMMENT 'Name_of_the_blood_bank' , `aPOS` INT(16) NOT NULL , `bPOS` INT(16) NOT NULL , `abPOS` INT(16) NOT NULL , `oPOS` INT(16) NOT NULL , `aNEG` INT(16) NOT NULL , `bNEG` INT(16) NOT NULL , `abNEG` INT(16) NOT NULL , `oNEG` INT(16) NOT NULL , `last_updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id_price`)) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT = 'price';
--<<<<<<<<<<<>>>>>>>>>>>>>

CREATE TABLE `easy_blood`.`state` ( 
    `id_state` SMALLINT(5) NOT NULL AUTO_INCREMENT , 
    `bbname` VARCHAR(128) NOT NULL UNIQUE COMMENT 'Name_of_the_blood_bank' , 
    `aPOS` INT(16) NOT NULL , 
    `bPOS` INT(16) NOT NULL , 
    `abPOS` INT(16) NOT NULL , 
    `oPOS` INT(16) NOT NULL , 
    `aNEG` INT(16) NOT NULL , 
    `bNEG` INT(16) NOT NULL , 
    `abNEG` INT(16) NOT NULL , 
    `oNEG` INT(16) NOT NULL , 
    `last_updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id_state`)) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT = 'amount of blood available now';

--<<<<<<<<<<>>>>>>>>>>>
ALTER TABLE `bbdb` ADD UNIQUE(`name`);

--<<<<<>>>>>>>>>>
INSERT INTO `bbdb` (`id`, `name`, `lat`, `long`, `plus_code`, `last_updated_at`) VALUES ('00001', 'HUPBD', '23.829312', '90.369339', "R9H9+MP Dhaka", current_timestamp());

INSERT INTO `price` (`id_price`, `bbname`, `aPOS`, `bPOS`, `abPOS`, `oPOS`, `aNEG`, `bNEG`, `abNEG`, `oNEG`, `last_updated_at`) VALUES ('20001', 'HUPBD', '45', '45', '55', '60', '90', '90', '110', '120', current_timestamp());

SELECT 
    bbdb.name, 
    state.aPOS, 
    price.aPOS, 
    state.last_updated_at 
FROM `easy_blood`.`bbdb` 
INNER JOIN `easy_blood`.`state` ON bbdb.name = state.bbname 
INNER JOIN price ON state.bbname = price.bbname



-- Insert sample data into `bbdb` with actual blood banks in Dhaka and auto-increment id
INSERT INTO `easy_blood`.`bbdb` (name, lat, `long`, plus_code)
VALUES
    ('Dhaka Blood Bank', 23.8103, 90.4125, '7C2V+9X Dhaka, Bangladesh'),
    ('BRAC Blood Bank', 23.7806, 90.2792, '7C2Q+5C Dhaka, Bangladesh'),
    ('Bangladesh Red Crescent Society', 23.7744, 90.3994, '7C2V+7J Dhaka, Bangladesh'),
    ('Dhaka Medical College Blood Bank', 23.7488, 90.3994, '7C2V+8F Dhaka, Bangladesh'),
    ('United Hospital Blood Bank', 23.7797, 90.4197, '7C2V+9F Dhaka, Bangladesh');

-- Insert fictitious sample data into `state`
INSERT INTO `easy_blood`.`state` (bbname, aPOS, bPOS, abPOS, oPOS, aNEG, bNEG, abNEG, oNEG, last_updated_at)
VALUES
    ('Dhaka Blood Bank', 5, 3, 2, 4, 1, 2, 0, 0, NOW()),
    ('BRAC Blood Bank', 3, 6, 1, 7, 2, 3, 1, 1, NOW()),
    ('Bangladesh Red Crescent Society', 7, 8, 5, 6, 3, 2, 2, 0, NOW()),
    ('Dhaka Medical College Blood Bank', 4, 2, 1, 3, 0, 1, 1, 0, NOW()),
    ('United Hospital Blood Bank', 6, 5, 4, 5, 2, 2, 0, 1, NOW());

-- Insert fictitious sample data into `price`
INSERT INTO `easy_blood`.`price` (bbname, aPOS, bPOS, abPOS, oPOS, aNEG, bNEG, abNEG, oNEG)
VALUES
    ('Dhaka Blood Bank', 100, 120, 150, 90, 110, 130, 140, 80),
    ('BRAC Blood Bank', 110, 125, 155, 95, 115, 135, 145, 85),
    ('Bangladesh Red Crescent Society', 105, 130, 160, 100, 120, 140, 150, 90),
    ('Dhaka Medical College Blood Bank', 95, 115, 145, 85, 105, 125, 135, 75),
    ('United Hospital Blood Bank', 120, 140, 170, 110, 130, 150, 160, 100);




-- ALTER TABLE `state` CHANGE `aPOS` `aPOS` INT(16) NOT NULL COMMENT 'qty', CHANGE `bPOS` `bPOS` INT(16) NOT NULL COMMENT 'qty', CHANGE `abPOS` `abPOS` INT(16) NOT NULL COMMENT 'qty', CHANGE `oPOS` `oPOS` INT(16) NOT NULL COMMENT 'qty', CHANGE `aNEG` `aNEG` INT(16) NOT NULL COMMENT 'qty', CHANGE `bNEG` `bNEG` INT(16) NOT NULL COMMENT 'qty', CHANGE `abNEG` `abNEG` INT(16) NOT NULL COMMENT 'qty', CHANGE `oNEG` `oNEG` INT(16) NOT NULL COMMENT 'qty';