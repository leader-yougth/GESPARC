<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191031011512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, customer_first_name VARCHAR(255) NOT NULL, customer_last_name VARCHAR(255) NOT NULL, customer_avatar VARCHAR(255) NOT NULL, customer_position_held VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom_entreprise VARCHAR(255) NOT NULL, secteur_activite VARCHAR(255) NOT NULL, logo_entreprise VARCHAR(255) NOT NULL, boite_postal VARCHAR(255) NOT NULL, site_web VARCHAR(255) NOT NULL, email_entreprise VARCHAR(255) NOT NULL, pays_entreprise VARCHAR(255) NOT NULL, ville_entreprise VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_account (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, is_admin TINYINT(1) NOT NULL, level INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_253B48AE9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_account DROP FOREIGN KEY FK_253B48AE9395C3F3');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE user_account');
    }
}
