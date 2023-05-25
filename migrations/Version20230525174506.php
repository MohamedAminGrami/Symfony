<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525174506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE presentateur_numero (presentateur_id INT NOT NULL, numero_id INT NOT NULL, INDEX IDX_5CAB1B1EEC3FD9F4 (presentateur_id), INDEX IDX_5CAB1B1E5D172A78 (numero_id), PRIMARY KEY(presentateur_id, numero_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE presentateur_numero ADD CONSTRAINT FK_5CAB1B1EEC3FD9F4 FOREIGN KEY (presentateur_id) REFERENCES presentateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE presentateur_numero ADD CONSTRAINT FK_5CAB1B1E5D172A78 FOREIGN KEY (numero_id) REFERENCES numero (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE numero DROP FOREIGN KEY numero_ibfk_1');
        $this->addSql('DROP INDEX code_p ON numero');
        $this->addSql('ALTER TABLE numero ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE presentateur DROP FOREIGN KEY presentateur_ibfk_1');
        $this->addSql('DROP INDEX code_r ON presentateur');
        $this->addSql('ALTER TABLE presentateur ADD id INT AUTO_INCREMENT NOT NULL, ADD role_id INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE presentateur ADD CONSTRAINT FK_3650B763D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_3650B763D60322AC ON presentateur (role_id)');
        $this->addSql('ALTER TABLE role ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presentateur_numero DROP FOREIGN KEY FK_5CAB1B1EEC3FD9F4');
        $this->addSql('ALTER TABLE presentateur_numero DROP FOREIGN KEY FK_5CAB1B1E5D172A78');
        $this->addSql('DROP TABLE presentateur_numero');
        $this->addSql('ALTER TABLE numero MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON numero');
        $this->addSql('ALTER TABLE numero DROP id');
        $this->addSql('ALTER TABLE numero ADD CONSTRAINT numero_ibfk_1 FOREIGN KEY (code_p) REFERENCES presentateur (code_p) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX code_p ON numero (code_p)');
        $this->addSql('ALTER TABLE numero ADD PRIMARY KEY (code_n)');
        $this->addSql('ALTER TABLE presentateur MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE presentateur DROP FOREIGN KEY FK_3650B763D60322AC');
        $this->addSql('DROP INDEX IDX_3650B763D60322AC ON presentateur');
        $this->addSql('DROP INDEX `PRIMARY` ON presentateur');
        $this->addSql('ALTER TABLE presentateur DROP id, DROP role_id');
        $this->addSql('ALTER TABLE presentateur ADD CONSTRAINT presentateur_ibfk_1 FOREIGN KEY (code_r) REFERENCES role (code_r) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX code_r ON presentateur (code_r)');
        $this->addSql('ALTER TABLE presentateur ADD PRIMARY KEY (code_p)');
        $this->addSql('ALTER TABLE role MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON role');
        $this->addSql('ALTER TABLE role DROP id');
        $this->addSql('ALTER TABLE role ADD PRIMARY KEY (code_r)');
    }
}
