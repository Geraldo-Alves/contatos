<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190510205643 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE endereco ADD id_contato_id INT NOT NULL');
        $this->addSql('ALTER TABLE endereco ADD CONSTRAINT FK_F8E0D60E17F33E91 FOREIGN KEY (id_contato_id) REFERENCES contato (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F8E0D60E17F33E91 ON endereco (id_contato_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE endereco DROP FOREIGN KEY FK_F8E0D60E17F33E91');
        $this->addSql('DROP INDEX UNIQ_F8E0D60E17F33E91 ON endereco');
        $this->addSql('ALTER TABLE endereco DROP id_contato_id');
    }
}
