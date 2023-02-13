<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113031716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE macher_coupon (id INT AUTO_INCREMENT NOT NULL, book_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, cote DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_63B3D8116A2B381 (book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE macher_coupon ADD CONSTRAINT FK_63B3D8116A2B381 FOREIGN KEY (book_id) REFERENCES book_maker (id)');
        $this->addSql('ALTER TABLE user CHANGE status status TINYINT(1) DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE macher_coupon DROP FOREIGN KEY FK_63B3D8116A2B381');
        $this->addSql('DROP TABLE macher_coupon');
        $this->addSql('ALTER TABLE user CHANGE status status TINYINT(1) NOT NULL');
    }
}
