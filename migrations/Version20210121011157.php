<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210121011157 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE oferta (id INT AUTO_INCREMENT NOT NULL, lote_id INT DEFAULT NULL, toro_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, empresa VARCHAR(255) NOT NULL, dnicuit VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telefono VARCHAR(255) NOT NULL, oferta VARCHAR(255) NOT NULL, status VARCHAR(255) DEFAULT NULL, fecha DATETIME NOT NULL, INDEX IDX_7479C8F2B172197C (lote_id), INDEX IDX_7479C8F25BEDE11 (toro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oferta ADD CONSTRAINT FK_7479C8F2B172197C FOREIGN KEY (lote_id) REFERENCES lote (id)');
        $this->addSql('ALTER TABLE oferta ADD CONSTRAINT FK_7479C8F25BEDE11 FOREIGN KEY (toro_id) REFERENCES toro (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE oferta');
    }
}
