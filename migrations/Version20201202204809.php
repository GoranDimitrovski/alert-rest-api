<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202204809 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alerts (id INT UNSIGNED AUTO_INCREMENT NOT NULL, sensor_id INT UNSIGNED NOT NULL, measurement1 INT NOT NULL, measurement2 INT NOT NULL, measurement3 INT NOT NULL, start_time DATETIME NOT NULL, end_time DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_F77AC06BA247991F (sensor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE measurements (id INT UNSIGNED AUTO_INCREMENT NOT NULL, sensor_id INT UNSIGNED DEFAULT NULL, level INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_71920F21A247991F (sensor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sensor_status (id INT UNSIGNED AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sensors (id INT UNSIGNED AUTO_INCREMENT NOT NULL, status_id INT UNSIGNED DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_D0D3FA90D17F50A6 (uuid), INDEX IDX_D0D3FA906BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alerts ADD CONSTRAINT FK_F77AC06BA247991F FOREIGN KEY (sensor_id) REFERENCES sensors (id)');
        $this->addSql('ALTER TABLE measurements ADD CONSTRAINT FK_71920F21A247991F FOREIGN KEY (sensor_id) REFERENCES sensors (id)');
        $this->addSql('ALTER TABLE sensors ADD CONSTRAINT FK_D0D3FA906BF700BD FOREIGN KEY (status_id) REFERENCES sensor_status (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sensors DROP FOREIGN KEY FK_D0D3FA906BF700BD');
        $this->addSql('ALTER TABLE alerts DROP FOREIGN KEY FK_F77AC06BA247991F');
        $this->addSql('ALTER TABLE measurements DROP FOREIGN KEY FK_71920F21A247991F');
        $this->addSql('DROP TABLE alerts');
        $this->addSql('DROP TABLE measurements');
        $this->addSql('DROP TABLE sensor_status');
        $this->addSql('DROP TABLE sensors');
    }
}
