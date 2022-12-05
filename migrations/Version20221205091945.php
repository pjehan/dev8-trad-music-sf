<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205091945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE manager (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musician (id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musician_instrument (musician_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_2F94EB1A9523AA8A (musician_id), INDEX IDX_2F94EB1ACF11D9C (instrument_id), PRIMARY KEY(musician_id, instrument_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, gig_id INT NOT NULL, instrument_id INT NOT NULL, musician_id INT DEFAULT NULL, INDEX IDX_D79F6B11FE058E5 (gig_id), INDEX IDX_D79F6B11CF11D9C (instrument_id), INDEX IDX_D79F6B119523AA8A (musician_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE manager ADD CONSTRAINT FK_FA2425B9BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musician ADD CONSTRAINT FK_31714127BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musician_instrument ADD CONSTRAINT FK_2F94EB1A9523AA8A FOREIGN KEY (musician_id) REFERENCES musician (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musician_instrument ADD CONSTRAINT FK_2F94EB1ACF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11FE058E5 FOREIGN KEY (gig_id) REFERENCES gig (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B119523AA8A FOREIGN KEY (musician_id) REFERENCES musician (id)');
        $this->addSql('ALTER TABLE pub ADD manager_id INT NOT NULL');
        $this->addSql('ALTER TABLE pub ADD CONSTRAINT FK_5A443C85783E3463 FOREIGN KEY (manager_id) REFERENCES manager (id)');
        $this->addSql('CREATE INDEX IDX_5A443C85783E3463 ON pub (manager_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pub DROP FOREIGN KEY FK_5A443C85783E3463');
        $this->addSql('ALTER TABLE manager DROP FOREIGN KEY FK_FA2425B9BF396750');
        $this->addSql('ALTER TABLE musician DROP FOREIGN KEY FK_31714127BF396750');
        $this->addSql('ALTER TABLE musician_instrument DROP FOREIGN KEY FK_2F94EB1A9523AA8A');
        $this->addSql('ALTER TABLE musician_instrument DROP FOREIGN KEY FK_2F94EB1ACF11D9C');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11FE058E5');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11CF11D9C');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B119523AA8A');
        $this->addSql('DROP TABLE manager');
        $this->addSql('DROP TABLE musician');
        $this->addSql('DROP TABLE musician_instrument');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_5A443C85783E3463 ON pub');
        $this->addSql('ALTER TABLE pub DROP manager_id');
    }
}
