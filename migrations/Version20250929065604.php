<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250929065604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE burger_fromage (burger_id INT NOT NULL, fromage_id INT NOT NULL, INDEX IDX_ED0377FE17CE5090 (burger_id), INDEX IDX_ED0377FE7FCE0491 (fromage_id), PRIMARY KEY(burger_id, fromage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fromage (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE burger_fromage ADD CONSTRAINT FK_ED0377FE17CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger_fromage ADD CONSTRAINT FK_ED0377FE7FCE0491 FOREIGN KEY (fromage_id) REFERENCES fromage (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE burger_fromage DROP FOREIGN KEY FK_ED0377FE17CE5090');
        $this->addSql('ALTER TABLE burger_fromage DROP FOREIGN KEY FK_ED0377FE7FCE0491');
        $this->addSql('DROP TABLE burger_fromage');
        $this->addSql('DROP TABLE fromage');
    }
}
