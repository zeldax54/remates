<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210114012009 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lote ADD raza_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lote ADD CONSTRAINT FK_65B4329F8CCBB6A9 FOREIGN KEY (raza_id) REFERENCES razas (id)');
        $this->addSql('CREATE INDEX IDX_65B4329F8CCBB6A9 ON lote (raza_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lote DROP FOREIGN KEY FK_65B4329F8CCBB6A9');
        $this->addSql('DROP INDEX IDX_65B4329F8CCBB6A9 ON lote');
        $this->addSql('ALTER TABLE lote DROP raza_id');
    }
}
