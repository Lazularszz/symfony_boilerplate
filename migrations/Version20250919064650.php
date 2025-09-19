<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250919064650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD burger_id INT NOT NULL, CHANGE name content VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC17CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC17CE5090 ON commentaire (burger_id)');
        $this->addSql('ALTER TABLE image CHANGE name path VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image CHANGE path name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC17CE5090');
        $this->addSql('DROP INDEX IDX_67F068BC17CE5090 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP burger_id, CHANGE content name VARCHAR(255) NOT NULL');
    }
}
