CREATE DATABASE tenders;

GRANT ALL PRIVILEGES ON tenders.* TO 'tenders'@'%' IDENTIFIED BY 'tenders';
GRANT ALL PRIVILEGES ON tenders.* TO 'tenders'@'localhost' IDENTIFIED BY 'tenders';