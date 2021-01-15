<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210115034036 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lote ADD cabana_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lote ADD CONSTRAINT FK_65B4329F7CBFCDB1 FOREIGN KEY (cabana_id) REFERENCES cabana (id)');
        $this->addSql('CREATE INDEX IDX_65B4329F7CBFCDB1 ON lote (cabana_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lote DROP FOREIGN KEY FK_65B4329F7CBFCDB1');
        $this->addSql('DROP INDEX IDX_65B4329F7CBFCDB1 ON lote');
        $this->addSql('ALTER TABLE lote DROP cabana_id');
    }
}
