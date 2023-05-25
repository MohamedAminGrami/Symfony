<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525183306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presentateur_numero DROP FOREIGN KEY FK_5CAB1B1E5D172A78');
        $this->addSql('ALTER TABLE presentateur_numero DROP FOREIGN KEY FK_5CAB1B1EEC3FD9F4');
        $this->addSql('DROP TABLE presentateur_numero');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE presentateur_numero (presentateur_id INT NOT NULL, numero_id INT NOT NULL, INDEX IDX_5CAB1B1EEC3FD9F4 (presentateur_id), INDEX IDX_5CAB1B1E5D172A78 (numero_id), PRIMARY KEY(presentateur_id, numero_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE presentateur_numero ADD CONSTRAINT FK_5CAB1B1E5D172A78 FOREIGN KEY (numero_id) REFERENCES numero (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE presentateur_numero ADD CONSTRAINT FK_5CAB1B1EEC3FD9F4 FOREIGN KEY (presentateur_id) REFERENCES presentateur (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
