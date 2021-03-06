ALTER TABLE employee DROP FOREIGN KEY employee_ibfk_1;
ALTER TABLE employer DROP FOREIGN KEY employer_ibfk_3;
ALTER TABLE job DROP FOREIGN KEY job_ibfk_4;

ALTER TABLE `location` CHANGE `id` `id` TINYINT(4) NOT NULL AUTO_INCREMENT;

ALTER TABLE `employee` ADD  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`employee_city`) REFERENCES `location`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `employer` ADD  CONSTRAINT `employer_ibfk_3` FOREIGN KEY (`city`) REFERENCES `location`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `job` ADD  CONSTRAINT `job_ibfk_4` FOREIGN KEY (`job_location_id`) REFERENCES `location`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `industry` CHANGE `id` `id` TINYINT(4) NOT NULL AUTO_INCREMENT;
ALTER TABLE `functional` CHANGE `id` `id` TINYINT(4) NOT NULL AUTO_INCREMENT;
ALTER TABLE `education` CHANGE `id` `id` TINYINT(4) NOT NULL AUTO_INCREMENT;
ALTER TABLE `designation` CHANGE `id` `id` TINYINT(4) NOT NULL AUTO_INCREMENT;
ALTER TABLE `country` CHANGE `id` `id` TINYINT(4) NOT NULL AUTO_INCREMENT;

ALTER TABLE ci_sessions DROP PRIMARY KEY,ADD PRIMARY KEY (id, ip_address);

ALTER TABLE `employee` CHANGE `employee_current_salary` `employee_current_salary` VARCHAR(25) NOT NULL;
ALTER TABLE `employee` CHANGE `employee_expected_salary` `employee_expected_salary` VARCHAR(25) NOT NULL;