<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210123021028 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cabana ADD fechainicio DATETIME NOT NULL, ADD fechacierre DATETIME NOT NULL, ADD info VARCHAR(500) NOT NULL, ADD condicionventa VARCHAR(300) NOT NULL');
        $this->addSql('ALTER TABLE lote DROP info, DROP condicionventa, DROP fechainicio, DROP fechacierre');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cabana DROP fechainicio, DROP fechacierre, DROP info, DROP condicionventa');
        $this->addSql('ALTER TABLE lote ADD info VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD condicionventa VARCHAR(300) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD fechainicio DATETIME NOT NULL, ADD fechacierre DATETIME NOT NULL');
    }
}
