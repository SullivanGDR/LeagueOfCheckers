<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002121349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partie ADD gagnant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D2F942B8 FOREIGN KEY (gagnant_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_59B1F3D2F942B8 ON partie (gagnant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D2F942B8');
        $this->addSql('DROP INDEX IDX_59B1F3D2F942B8 ON partie');
        $this->addSql('ALTER TABLE partie DROP gagnant_id');
    }
}
