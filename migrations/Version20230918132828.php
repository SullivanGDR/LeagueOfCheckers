<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230918132828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE deplacement (id INT AUTO_INCREMENT NOT NULL, posseder_id INT NOT NULL, emplacement_x VARCHAR(255) NOT NULL, emplacement_y VARCHAR(255) NOT NULL, arrivee_x VARCHAR(255) NOT NULL, arrivee_y VARCHAR(255) NOT NULL, INDEX IDX_1296FAC21DB77787 (posseder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mouvement (id INT AUTO_INCREMENT NOT NULL, executer_id INT NOT NULL, emplacement_x VARCHAR(255) NOT NULL, emplacement_y VARCHAR(255) NOT NULL, arrivee_x VARCHAR(255) NOT NULL, arrivee_y VARCHAR(255) NOT NULL, type_mouvement VARCHAR(255) NOT NULL, INDEX IDX_5B51FC3EC00D111A (executer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, joueur1_id INT NOT NULL, joueur2_id INT NOT NULL, nb_coup_j1 INT NOT NULL, nb_coup_j2 INT NOT NULL, code_partie VARCHAR(255) NOT NULL, etat_partie TINYINT(1) NOT NULL, etat_plateau LONGTEXT NOT NULL, INDEX IDX_59B1F3D92C1E237 (joueur1_id), INDEX IDX_59B1F3D80744DD9 (joueur2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie_deplacement (partie_id INT NOT NULL, deplacement_id INT NOT NULL, INDEX IDX_887F798AE075F7A4 (partie_id), INDEX IDX_887F798A355B84A (deplacement_id), PRIMARY KEY(partie_id, deplacement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rang (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, score_min INT NOT NULL, score_max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, rang_id INT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, nb_victoire INT NOT NULL, nb_defaite INT NOT NULL, nb_total_partie INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D6493CC0D837 (rang_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_partie (user_id INT NOT NULL, partie_id INT NOT NULL, INDEX IDX_60C90400A76ED395 (user_id), INDEX IDX_60C90400E075F7A4 (partie_id), PRIMARY KEY(user_id, partie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deplacement ADD CONSTRAINT FK_1296FAC21DB77787 FOREIGN KEY (posseder_id) REFERENCES mouvement (id)');
        $this->addSql('ALTER TABLE mouvement ADD CONSTRAINT FK_5B51FC3EC00D111A FOREIGN KEY (executer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D92C1E237 FOREIGN KEY (joueur1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D80744DD9 FOREIGN KEY (joueur2_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE partie_deplacement ADD CONSTRAINT FK_887F798AE075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie_deplacement ADD CONSTRAINT FK_887F798A355B84A FOREIGN KEY (deplacement_id) REFERENCES deplacement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493CC0D837 FOREIGN KEY (rang_id) REFERENCES rang (id)');
        $this->addSql('ALTER TABLE user_partie ADD CONSTRAINT FK_60C90400A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_partie ADD CONSTRAINT FK_60C90400E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deplacement DROP FOREIGN KEY FK_1296FAC21DB77787');
        $this->addSql('ALTER TABLE mouvement DROP FOREIGN KEY FK_5B51FC3EC00D111A');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D92C1E237');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D80744DD9');
        $this->addSql('ALTER TABLE partie_deplacement DROP FOREIGN KEY FK_887F798AE075F7A4');
        $this->addSql('ALTER TABLE partie_deplacement DROP FOREIGN KEY FK_887F798A355B84A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493CC0D837');
        $this->addSql('ALTER TABLE user_partie DROP FOREIGN KEY FK_60C90400A76ED395');
        $this->addSql('ALTER TABLE user_partie DROP FOREIGN KEY FK_60C90400E075F7A4');
        $this->addSql('DROP TABLE deplacement');
        $this->addSql('DROP TABLE mouvement');
        $this->addSql('DROP TABLE partie');
        $this->addSql('DROP TABLE partie_deplacement');
        $this->addSql('DROP TABLE rang');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_partie');
    }
}
