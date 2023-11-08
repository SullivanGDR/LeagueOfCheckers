<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108135244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, joueur_b_id INT DEFAULT NULL, joueur_n_id INT NOT NULL, winner_id INT DEFAULT NULL, date_partie DATETIME NOT NULL, etat_plateau LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', nb_coup_jn INT NOT NULL, nb_coup_jb INT NOT NULL, timer TIME DEFAULT NULL, nb_tour INT NOT NULL, nb_pion_n INT NOT NULL, nb_pion_b INT NOT NULL, code_partie VARCHAR(255) NOT NULL, INDEX IDX_59B1F3D91F9201E (joueur_b_id), INDEX IDX_59B1F3DDB2F9FA6 (joueur_n_id), INDEX IDX_59B1F3D5DFCD4B8 (winner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D91F9201E FOREIGN KEY (joueur_b_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3DDB2F9FA6 FOREIGN KEY (joueur_n_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D5DFCD4B8 FOREIGN KEY (winner_id) REFERENCES joueur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D91F9201E');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3DDB2F9FA6');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D5DFCD4B8');
        $this->addSql('DROP TABLE partie');
    }
}
