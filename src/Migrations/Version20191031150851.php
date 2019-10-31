<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191031150851 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_account ADD users_group_id INT DEFAULT NULL, CHANGE customer_id customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AE8515F29D FOREIGN KEY (users_group_id) REFERENCES users_group (id)');
        $this->addSql('CREATE INDEX IDX_253B48AE8515F29D ON user_account (users_group_id)');
        $this->addSql('ALTER TABLE users_group ADD created_at DATETIME NOT NULL, DROP avaible_users, DROP role');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_account DROP FOREIGN KEY FK_253B48AE8515F29D');
        $this->addSql('DROP INDEX IDX_253B48AE8515F29D ON user_account');
        $this->addSql('ALTER TABLE user_account DROP users_group_id, CHANGE customer_id customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users_group ADD avaible_users LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:array)\', ADD role LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:array)\', DROP created_at');
    }
}
