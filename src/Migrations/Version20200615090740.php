<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200615090740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADEC886B8');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD2A69AB62');
        $this->addSql('DROP TABLE bracelets');
        $this->addSql('DROP TABLE cases');
        $this->addSql('DROP INDEX IDX_D34A04AD2A69AB62 ON product');
        $this->addSql('DROP INDEX IDX_D34A04ADEC886B8 ON product');
        $this->addSql('ALTER TABLE product ADD cases VARCHAR(30) NOT NULL, ADD bracelet VARCHAR(30) NOT NULL, DROP cases_id, DROP bracelet_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bracelets (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cases (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product ADD cases_id INT NOT NULL, ADD bracelet_id INT NOT NULL, DROP cases, DROP bracelet');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD2A69AB62 FOREIGN KEY (cases_id) REFERENCES cases (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADEC886B8 FOREIGN KEY (bracelet_id) REFERENCES bracelets (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD2A69AB62 ON product (cases_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADEC886B8 ON product (bracelet_id)');
    }
}
