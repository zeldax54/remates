<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210925220749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lote ADD cabanaentity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lote ADD CONSTRAINT FK_65B4329F13B1B6D3 FOREIGN KEY (cabanaentity_id) REFERENCES cabana_entity (id)');
        $this->addSql('CREATE INDEX IDX_65B4329F13B1B6D3 ON lote (cabanaentity_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lote DROP FOREIGN KEY FK_65B4329F13B1B6D3');
        $this->addSql('DROP INDEX IDX_65B4329F13B1B6D3 ON lote');
        $this->addSql('ALTER TABLE lote DROP cabanaentity_id');
    }
}
