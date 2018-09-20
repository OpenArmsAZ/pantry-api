<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180914012630 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(45) NOT NULL, last_name VARCHAR(45) NOT NULL, email_address VARCHAR(45) NOT NULL, recovery_token VARCHAR(255) DEFAULT NULL, password VARCHAR(75) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9B08E074E (email_address), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, description LONGTEXT DEFAULT NULL, upc VARCHAR(45) DEFAULT NULL, shareable_quantity INT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, UNIQUE INDEX UNIQ_B3BA5A5A56FF3ABD (upc), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE products');
    }
}
