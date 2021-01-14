<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113162126 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lote (id INT AUTO_INCREMENT NOT NULL, gallery LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', nombre VARCHAR(255) NOT NULL, info VARCHAR(500) NOT NULL, condicionventa VARCHAR(300) NOT NULL, fechainicio DATETIME NOT NULL, fechacierre DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE toro ADD lote_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE toro ADD CONSTRAINT FK_46960377B172197C FOREIGN KEY (lote_id) REFERENCES lote (id)');
        $this->addSql('CREATE INDEX IDX_46960377B172197C ON toro (lote_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE toro DROP FOREIGN KEY FK_46960377B172197C');
        $this->addSql('DROP TABLE lote');
        $this->addSql('DROP INDEX IDX_46960377B172197C ON toro');
        $this->addSql('ALTER TABLE toro DROP lote_id');
    }
}
