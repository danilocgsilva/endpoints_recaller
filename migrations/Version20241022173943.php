<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241022173943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE applications (id INT AUTO_INCREMENT NOT NULL, application VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dns (id INT AUTO_INCREMENT NOT NULL, application_id INT DEFAULT NULL, dns VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_82EDDC413E030ACD (application_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE endpoints (id INT AUTO_INCREMENT NOT NULL, dns_id INT DEFAULT NULL, path VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_DC1D25B0E42F3693 (dns_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dns ADD CONSTRAINT FK_82EDDC413E030ACD FOREIGN KEY (application_id) REFERENCES applications (id)');
        $this->addSql('ALTER TABLE endpoints ADD CONSTRAINT FK_DC1D25B0E42F3693 FOREIGN KEY (dns_id) REFERENCES dns (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dns DROP FOREIGN KEY FK_82EDDC413E030ACD');
        $this->addSql('ALTER TABLE endpoints DROP FOREIGN KEY FK_DC1D25B0E42F3693');
        $this->addSql('DROP TABLE applications');
        $this->addSql('DROP TABLE dns');
        $this->addSql('DROP TABLE endpoints');
    }
}
