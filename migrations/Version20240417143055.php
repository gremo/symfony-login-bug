<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240417143055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE app_profile (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6C0A2A4277153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, profile_id INT NOT NULL, username VARCHAR(180) NOT NULL, password VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password_hasher_name VARCHAR(32) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D649CCFA12B8 (profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CCFA12B8 FOREIGN KEY (profile_id) REFERENCES app_profile (id) ON DELETE CASCADE');

        // Dummy data
        $this->addSql('INSERT INTO app_profile (id, code) VALUES (1, "localhost")');
        // User password is "bar"
        $this->addSql('INSERT INTO user (id, username, password, roles, password_hasher_name, profile_id) VALUES (1, "foo", "37b51d194a7513e45b56f6524f2d51f2", "[]", "md5", 1)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CCFA12B8');
        $this->addSql('DROP TABLE app_profile');
        $this->addSql('DROP TABLE user');
    }
}
