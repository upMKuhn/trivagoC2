<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version1 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE floor_subscription (id INT AUTO_INCREMENT NOT NULL, floor_id INT DEFAULT NULL, subscriber_id INT DEFAULT NULL, INDEX IDX_34A4DF14854679E2 (floor_id), INDEX IDX_34A4DF147808B1AD (subscriber_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE building_floor (id INT AUTO_INCREMENT NOT NULL, building_id INT DEFAULT NULL, floorNumber INT NOT NULL, floorName VARCHAR(255) NOT NULL, INDEX IDX_D2E567B44D2A7E12 (building_id), UNIQUE INDEX floorNameNumber (floorNumber, floorName), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D1E4336A5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue_comment (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, issue_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, INDEX IDX_318C178DF675F31B (author_id), INDEX IDX_318C178D5E7AA58C (issue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE building (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E16F61D45E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE floor_section (id INT AUTO_INCREMENT NOT NULL, SectionName VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, category_id INT DEFAULT NULL, priority_id INT DEFAULT NULL, state_id INT DEFAULT NULL, floor_id INT DEFAULT NULL, Title VARCHAR(255) NOT NULL, Location VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, INDEX IDX_12AD233E61220EA6 (creator_id), INDEX IDX_12AD233E12469DE2 (category_id), INDEX IDX_12AD233E497B19F9 (priority_id), INDEX IDX_12AD233E5D83CC1 (state_id), INDEX IDX_12AD233E854679E2 (floor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advanced_user (id INT AUTO_INCREMENT NOT NULL, Username VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles INT NOT NULL, api_key VARCHAR(100) DEFAULT NULL, api_key_expiry DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_494D67FFE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue_subscription (id INT AUTO_INCREMENT NOT NULL, subscriber_id INT DEFAULT NULL, issue_id INT DEFAULT NULL, INDEX IDX_721F48777808B1AD (subscriber_id), INDEX IDX_721F48775E7AA58C (issue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue_state (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, asNumber INT NOT NULL, UNIQUE INDEX UNIQ_3119BBA85E237E06 (name), UNIQUE INDEX UNIQ_3119BBA8841D0E3B (asNumber), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue_priority (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, needToActionValue INT NOT NULL, UNIQUE INDEX UNIQ_B50EF68C5E237E06 (name), UNIQUE INDEX UNIQ_B50EF68CD562D96E (needToActionValue), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE floor_subscription ADD CONSTRAINT FK_34A4DF14854679E2 FOREIGN KEY (floor_id) REFERENCES building_floor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE floor_subscription ADD CONSTRAINT FK_34A4DF147808B1AD FOREIGN KEY (subscriber_id) REFERENCES advanced_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE building_floor ADD CONSTRAINT FK_D2E567B44D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id)');
        $this->addSql('ALTER TABLE issue_comment ADD CONSTRAINT FK_318C178DF675F31B FOREIGN KEY (author_id) REFERENCES advanced_user (id)');
        $this->addSql('ALTER TABLE issue_comment ADD CONSTRAINT FK_318C178D5E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id)');
        $this->addSql('ALTER TABLE issue ADD CONSTRAINT FK_12AD233E61220EA6 FOREIGN KEY (creator_id) REFERENCES advanced_user (id)');
        $this->addSql('ALTER TABLE issue ADD CONSTRAINT FK_12AD233E12469DE2 FOREIGN KEY (category_id) REFERENCES issue_category (id)');
        $this->addSql('ALTER TABLE issue ADD CONSTRAINT FK_12AD233E497B19F9 FOREIGN KEY (priority_id) REFERENCES issue_priority (id)');
        $this->addSql('ALTER TABLE issue ADD CONSTRAINT FK_12AD233E5D83CC1 FOREIGN KEY (state_id) REFERENCES issue_state (id)');
        $this->addSql('ALTER TABLE issue ADD CONSTRAINT FK_12AD233E854679E2 FOREIGN KEY (floor_id) REFERENCES building_floor (id)');
        $this->addSql('ALTER TABLE issue_subscription ADD CONSTRAINT FK_721F48777808B1AD FOREIGN KEY (subscriber_id) REFERENCES advanced_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE issue_subscription ADD CONSTRAINT FK_721F48775E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id) ON DELETE CASCADE');


        $this->addSql("INSERT INTO `issue_category` (`id`, `name`) VALUES(1, 'Maintainance'),(2, 'Supplies');");
        $this->addSql("INSERT INTO `issue_priority` (`id`, `name`, `needToActionValue`) VALUES(1, 'low', 0),(2, 'medium', 1),(3, 'high', 4),(4, 'critical', 8);");
        $this->addSql("INSERT INTO `issue_state` (`id`, `name`, `asNumber`) VALUES(1, 'created', 0),(2, 'progressing', 1),(3, 'resolved', 3),(4, 'blocked', 2);");
        $this->addSql("INSERT INTO `advanced_user` (`id`, `Username`, `email`, `password`, `roles`, `api_key`, `api_key_expiry`) VALUES(1, 'admin', 'asdjkljklasdgf@gmail.com', '$2y$10\$x/pHdKOAj7gcAr0GYGx7k.IOIaBdtGUwQ.jJKgOlD5daVxXG4eFby', 7, NULL, NULL),(3, 'user', 'user@gmail.com', '$2y$10\$x/pHdKOAj7gcAr0GYGx7k.IOIaBdtGUwQ.jJKgOlD5daVxXG4eFby', 1, NULL, NULL),(4, 'hero', 'hero@gmail.com', '$2y$10\$x/pHdKOAj7gcAr0GYGx7k.IOIaBdtGUwQ.jJKgOlD5daVxXG4eFby', 3, NULL, NULL);");


    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE floor_subscription DROP FOREIGN KEY FK_34A4DF14854679E2');
        $this->addSql('ALTER TABLE issue DROP FOREIGN KEY FK_12AD233E854679E2');
        $this->addSql('ALTER TABLE issue DROP FOREIGN KEY FK_12AD233E12469DE2');
        $this->addSql('ALTER TABLE building_floor DROP FOREIGN KEY FK_D2E567B44D2A7E12');
        $this->addSql('ALTER TABLE issue_comment DROP FOREIGN KEY FK_318C178D5E7AA58C');
        $this->addSql('ALTER TABLE issue_subscription DROP FOREIGN KEY FK_721F48775E7AA58C');
        $this->addSql('ALTER TABLE floor_subscription DROP FOREIGN KEY FK_34A4DF147808B1AD');
        $this->addSql('ALTER TABLE issue_comment DROP FOREIGN KEY FK_318C178DF675F31B');
        $this->addSql('ALTER TABLE issue DROP FOREIGN KEY FK_12AD233E61220EA6');
        $this->addSql('ALTER TABLE issue_subscription DROP FOREIGN KEY FK_721F48777808B1AD');
        $this->addSql('ALTER TABLE issue DROP FOREIGN KEY FK_12AD233E5D83CC1');
        $this->addSql('ALTER TABLE issue DROP FOREIGN KEY FK_12AD233E497B19F9');
        $this->addSql('DROP TABLE floor_subscription');
        $this->addSql('DROP TABLE building_floor');
        $this->addSql('DROP TABLE issue_category');
        $this->addSql('DROP TABLE issue_comment');
        $this->addSql('DROP TABLE building');
        $this->addSql('DROP TABLE floor_section');
        $this->addSql('DROP TABLE issue');
        $this->addSql('DROP TABLE advanced_user');
        $this->addSql('DROP TABLE issue_subscription');
        $this->addSql('DROP TABLE issue_state');
        $this->addSql('DROP TABLE issue_priority');
    }
}
