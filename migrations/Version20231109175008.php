<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231109175008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partie_deplacement (partie_id INT NOT NULL, deplacement_id INT NOT NULL, INDEX IDX_887F798AE075F7A4 (partie_id), INDEX IDX_887F798A355B84A (deplacement_id), PRIMARY KEY(partie_id, deplacement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partie_deplacement ADD CONSTRAINT FK_887F798AE075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie_deplacement ADD CONSTRAINT FK_887F798A355B84A FOREIGN KEY (deplacement_id) REFERENCES deplacement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partie_deplacement DROP FOREIGN KEY FK_887F798AE075F7A4');
        $this->addSql('ALTER TABLE partie_deplacement DROP FOREIGN KEY FK_887F798A355B84A');
        $this->addSql('DROP TABLE partie_deplacement');
    }
}
