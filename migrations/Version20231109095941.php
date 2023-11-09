<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231109095941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE deplacement (id INT AUTO_INCREMENT NOT NULL, mouvement_id INT NOT NULL, emplacement_x INT NOT NULL, emplacement_y INT NOT NULL, arrive_x INT NOT NULL, arrive_y INT NOT NULL, INDEX IDX_1296FAC2ECD1C222 (mouvement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, rang_id INT NOT NULL, theme_pion_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nb_victoire INT NOT NULL, nb_defaite INT NOT NULL, nb_totale_partie INT NOT NULL, monnaie INT NOT NULL, UNIQUE INDEX UNIQ_FD71A9C5F85E0677 (username), INDEX IDX_FD71A9C53CC0D837 (rang_id), INDEX IDX_FD71A9C55E07286A (theme_pion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mouvement (id INT AUTO_INCREMENT NOT NULL, joueur_id INT NOT NULL, emplacement_x INT NOT NULL, emplacement_y INT NOT NULL, arrive_x INT NOT NULL, arrive_y INT NOT NULL, type_mouv VARCHAR(255) NOT NULL, INDEX IDX_5B51FC3EA9E2D76C (joueur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, joueur_b_id INT DEFAULT NULL, joueur_n_id INT NOT NULL, winner_id INT DEFAULT NULL, date_partie DATETIME NOT NULL, etat_plateau LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', nb_coup_jn INT NOT NULL, nb_coup_jb INT NOT NULL, timer TIME DEFAULT NULL, nb_tour INT NOT NULL, nb_pion_n INT NOT NULL, nb_pion_b INT NOT NULL, code_partie VARCHAR(255) NOT NULL, INDEX IDX_59B1F3D91F9201E (joueur_b_id), INDEX IDX_59B1F3DDB2F9FA6 (joueur_n_id), INDEX IDX_59B1F3D5DFCD4B8 (winner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rang (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, score_min INT NOT NULL, score_max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme_pion (id INT AUTO_INCREMENT NOT NULL, couleur VARCHAR(50) NOT NULL, argb VARCHAR(50) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deplacement ADD CONSTRAINT FK_1296FAC2ECD1C222 FOREIGN KEY (mouvement_id) REFERENCES mouvement (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C53CC0D837 FOREIGN KEY (rang_id) REFERENCES rang (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C55E07286A FOREIGN KEY (theme_pion_id) REFERENCES theme_pion (id)');
        $this->addSql('ALTER TABLE mouvement ADD CONSTRAINT FK_5B51FC3EA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D91F9201E FOREIGN KEY (joueur_b_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3DDB2F9FA6 FOREIGN KEY (joueur_n_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D5DFCD4B8 FOREIGN KEY (winner_id) REFERENCES joueur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deplacement DROP FOREIGN KEY FK_1296FAC2ECD1C222');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C53CC0D837');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C55E07286A');
        $this->addSql('ALTER TABLE mouvement DROP FOREIGN KEY FK_5B51FC3EA9E2D76C');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D91F9201E');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3DDB2F9FA6');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D5DFCD4B8');
        $this->addSql('DROP TABLE deplacement');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE mouvement');
        $this->addSql('DROP TABLE partie');
        $this->addSql('DROP TABLE rang');
        $this->addSql('DROP TABLE theme_pion');
    }
}
