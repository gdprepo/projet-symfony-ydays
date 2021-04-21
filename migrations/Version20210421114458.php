<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210421114458 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE slider (id INT AUTO_INCREMENT NOT NULL, logo VARCHAR(255) DEFAULT NULL, sld VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prono ADD created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD date_sub DATETIME DEFAULT NULL, ADD stripe_public VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vip ADD duree INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE slider');
        $this->addSql('ALTER TABLE prono DROP created_at');
        $this->addSql('ALTER TABLE user DROP date_sub, DROP stripe_public');
        $this->addSql('ALTER TABLE vip DROP duree');
    }
}
