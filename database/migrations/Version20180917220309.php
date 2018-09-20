<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180917220309 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE inventory_levels (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, shareable_quantity INT NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, UNIQUE INDEX UNIQ_9FF6F8B24584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donations (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, shareable_quantity INT NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_CDE989624584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inventory_levels ADD CONSTRAINT FK_9FF6F8B24584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE donations ADD CONSTRAINT FK_CDE989624584665A FOREIGN KEY (product_id) REFERENCES products (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE inventory_levels');
        $this->addSql('DROP TABLE donations');
    }
}
