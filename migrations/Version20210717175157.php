<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210717175157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE society (id INT AUTO_INCREMENT NOT NULL, code_postal_id INT DEFAULT NULL, ville_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_D6461F2B2B59251 (code_postal_id), INDEX IDX_D6461F2A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society_type_society (society_id INT NOT NULL, type_society_id INT NOT NULL, INDEX IDX_A3D8CE1BE6389D24 (society_id), INDEX IDX_A3D8CE1BFB3B4B01 (type_society_id), PRIMARY KEY(society_id, type_society_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE society ADD CONSTRAINT FK_D6461F2B2B59251 FOREIGN KEY (code_postal_id) REFERENCES code_postal (id)');
        $this->addSql('ALTER TABLE society ADD CONSTRAINT FK_D6461F2A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE society_type_society ADD CONSTRAINT FK_A3D8CE1BE6389D24 FOREIGN KEY (society_id) REFERENCES society (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE society_type_society ADD CONSTRAINT FK_A3D8CE1BFB3B4B01 FOREIGN KEY (type_society_id) REFERENCES type_society (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ville CHANGE code_postal_id code_postal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3B2B59251 FOREIGN KEY (code_postal_id) REFERENCES code_postal (id)');
        $this->addSql('CREATE INDEX IDX_43C3D9C3B2B59251 ON ville (code_postal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE society_type_society DROP FOREIGN KEY FK_A3D8CE1BE6389D24');
        $this->addSql('DROP TABLE society');
        $this->addSql('DROP TABLE society_type_society');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3B2B59251');
        $this->addSql('DROP INDEX IDX_43C3D9C3B2B59251 ON ville');
        $this->addSql('ALTER TABLE ville CHANGE code_postal_id code_postal_id INT NOT NULL');
    }
}
