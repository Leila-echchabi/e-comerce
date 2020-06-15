<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200614131655 extends AbstractMigration
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
        $this->addSql('ALTER TABLE product_tags DROP FOREIGN KEY FK_E254B6878D7B4FB4');
        $this->addSql('DROP TABLE bracelet');
        $this->addSql('DROP TABLE product_tags');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP INDEX IDX_D34A04ADEC886B8 ON product');
        $this->addSql('ALTER TABLE product DROP bracelet_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bracelet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product_tags (product_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_E254B6874584665A (product_id), INDEX IDX_E254B6878D7B4FB4 (tags_id), PRIMARY KEY(product_id, tags_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product_tags ADD CONSTRAINT FK_E254B6874584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_tags ADD CONSTRAINT FK_E254B6878D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD bracelet_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADEC886B8 FOREIGN KEY (bracelet_id) REFERENCES bracelet (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADEC886B8 ON product (bracelet_id)');
    }
}
