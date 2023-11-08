<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108140254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE deplacement (id INT AUTO_INCREMENT NOT NULL, mouvement_id INT NOT NULL, emplacement_x INT NOT NULL, emplacement_y INT NOT NULL, arrive_x INT NOT NULL, arrive_y INT NOT NULL, INDEX IDX_1296FAC2ECD1C222 (mouvement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mouvement (id INT AUTO_INCREMENT NOT NULL, joueur_id INT NOT NULL, emplacement_x INT NOT NULL, emplacement_y INT NOT NULL, arrive_x INT NOT NULL, arrive_y INT NOT NULL, type_mouv VARCHAR(255) NOT NULL, INDEX IDX_5B51FC3EA9E2D76C (joueur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deplacement ADD CONSTRAINT FK_1296FAC2ECD1C222 FOREIGN KEY (mouvement_id) REFERENCES mouvement (id)');
        $this->addSql('ALTER TABLE mouvement ADD CONSTRAINT FK_5B51FC3EA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deplacement DROP FOREIGN KEY FK_1296FAC2ECD1C222');
        $this->addSql('ALTER TABLE mouvement DROP FOREIGN KEY FK_5B51FC3EA9E2D76C');
        $this->addSql('DROP TABLE deplacement');
        $this->addSql('DROP TABLE mouvement');
    }
}
