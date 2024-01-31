<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131131101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D8698A76C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_level (document_id INT NOT NULL, level_id INT NOT NULL, INDEX IDX_F34BBA61C33F7837 (document_id), INDEX IDX_F34BBA615FB14BA7 (level_id), PRIMARY KEY(document_id, level_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_subject (document_id INT NOT NULL, subject_id INT NOT NULL, INDEX IDX_5FA198A6C33F7837 (document_id), INDEX IDX_5FA198A623EDC87 (subject_id), PRIMARY KEY(document_id, subject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_theme (document_id INT NOT NULL, theme_id INT NOT NULL, INDEX IDX_FED4917AC33F7837 (document_id), INDEX IDX_FED4917A59027487 (theme_id), PRIMARY KEY(document_id, theme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, subject_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_9775E70823EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE document_level ADD CONSTRAINT FK_F34BBA61C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_level ADD CONSTRAINT FK_F34BBA615FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_subject ADD CONSTRAINT FK_5FA198A6C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_subject ADD CONSTRAINT FK_5FA198A623EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_theme ADD CONSTRAINT FK_FED4917AC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_theme ADD CONSTRAINT FK_FED4917A59027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E70823EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76C54C8C93');
        $this->addSql('ALTER TABLE document_level DROP FOREIGN KEY FK_F34BBA61C33F7837');
        $this->addSql('ALTER TABLE document_level DROP FOREIGN KEY FK_F34BBA615FB14BA7');
        $this->addSql('ALTER TABLE document_subject DROP FOREIGN KEY FK_5FA198A6C33F7837');
        $this->addSql('ALTER TABLE document_subject DROP FOREIGN KEY FK_5FA198A623EDC87');
        $this->addSql('ALTER TABLE document_theme DROP FOREIGN KEY FK_FED4917AC33F7837');
        $this->addSql('ALTER TABLE document_theme DROP FOREIGN KEY FK_FED4917A59027487');
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E70823EDC87');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE document_level');
        $this->addSql('DROP TABLE document_subject');
        $this->addSql('DROP TABLE document_theme');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE type');
    }
}
