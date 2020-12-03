<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203145924 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, grid_id INT NOT NULL, start_time DATETIME NOT NULL, end_time DATETIME NOT NULL, number_of_tests INT NOT NULL, result INT NOT NULL, INDEX IDX_232B318CA76ED395 (user_id), INDEX IDX_232B318C2CF16895 (grid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grid (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, level INT NOT NULL, initial_structure LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', solution LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ranking (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ranking_user (ranking_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_24AE59C320F64684 (ranking_id), INDEX IDX_24AE59C3A76ED395 (user_id), PRIMARY KEY(ranking_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, score INT NOT NULL, level INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C2CF16895 FOREIGN KEY (grid_id) REFERENCES grid (id)');
        $this->addSql('ALTER TABLE ranking_user ADD CONSTRAINT FK_24AE59C320F64684 FOREIGN KEY (ranking_id) REFERENCES ranking (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ranking_user ADD CONSTRAINT FK_24AE59C3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C2CF16895');
        $this->addSql('ALTER TABLE ranking_user DROP FOREIGN KEY FK_24AE59C320F64684');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CA76ED395');
        $this->addSql('ALTER TABLE ranking_user DROP FOREIGN KEY FK_24AE59C3A76ED395');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE grid');
        $this->addSql('DROP TABLE ranking');
        $this->addSql('DROP TABLE ranking_user');
        $this->addSql('DROP TABLE user');
    }
}
