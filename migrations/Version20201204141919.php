<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201204141919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grid ADD game_id INT NOT NULL');
        $this->addSql('ALTER TABLE grid ADD CONSTRAINT FK_2E20D937E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_2E20D937E48FD905 ON grid (game_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grid DROP FOREIGN KEY FK_2E20D937E48FD905');
        $this->addSql('DROP INDEX IDX_2E20D937E48FD905 ON grid');
        $this->addSql('ALTER TABLE grid DROP game_id');
    }
}
