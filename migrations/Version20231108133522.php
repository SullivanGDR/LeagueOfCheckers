<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108133522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rang (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, score_min INT NOT NULL, score_max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme_pion (id INT AUTO_INCREMENT NOT NULL, couleur VARCHAR(50) NOT NULL, argb VARCHAR(50) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE joueur ADD rang_id INT NOT NULL, ADD theme_pion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C53CC0D837 FOREIGN KEY (rang_id) REFERENCES rang (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C55E07286A FOREIGN KEY (theme_pion_id) REFERENCES theme_pion (id)');
        $this->addSql('CREATE INDEX IDX_FD71A9C53CC0D837 ON joueur (rang_id)');
        $this->addSql('CREATE INDEX IDX_FD71A9C55E07286A ON joueur (theme_pion_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C53CC0D837');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C55E07286A');
        $this->addSql('DROP TABLE rang');
        $this->addSql('DROP TABLE theme_pion');
        $this->addSql('DROP INDEX IDX_FD71A9C53CC0D837 ON joueur');
        $this->addSql('DROP INDEX IDX_FD71A9C55E07286A ON joueur');
        $this->addSql('ALTER TABLE joueur DROP rang_id, DROP theme_pion_id');
    }
}
