<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181213143358 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE language (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', title VARCHAR(255) NOT NULL, content LONGBLOB NOT NULL, category VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_5A8A6C8DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', username VARCHAR(255) NOT NULL, password VARCHAR(128) NOT NULL, fullname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, verified TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_language (user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', language_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_AF9A5A6FA76ED395 (user_id), INDEX IDX_AF9A5A6F82F1BAF4 (language_id), PRIMARY KEY(user_id, language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE follower (user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', follower_user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_B9D60946A76ED395 (user_id), INDEX IDX_B9D6094670FC2906 (follower_user_id), PRIMARY KEY(user_id, follower_user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE users_language ADD CONSTRAINT FK_AF9A5A6FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE users_language ADD CONSTRAINT FK_AF9A5A6F82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE follower ADD CONSTRAINT FK_B9D60946A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE follower ADD CONSTRAINT FK_B9D6094670FC2906 FOREIGN KEY (follower_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users_language DROP FOREIGN KEY FK_AF9A5A6F82F1BAF4');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('ALTER TABLE users_language DROP FOREIGN KEY FK_AF9A5A6FA76ED395');
        $this->addSql('ALTER TABLE follower DROP FOREIGN KEY FK_B9D60946A76ED395');
        $this->addSql('ALTER TABLE follower DROP FOREIGN KEY FK_B9D6094670FC2906');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE users_language');
        $this->addSql('DROP TABLE follower');
    }
}
