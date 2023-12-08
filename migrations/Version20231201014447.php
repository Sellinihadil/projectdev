<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231201014447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cours_categories (cours_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_3F0BB4417ECF78B0 (cours_id), INDEX IDX_3F0BB441A21214B7 (categories_id), PRIMARY KEY(cours_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours_categories ADD CONSTRAINT FK_3F0BB4417ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_categories ADD CONSTRAINT FK_3F0BB441A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planning ADD cours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planning ADD CONSTRAINT FK_D499BFF67ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_D499BFF67ECF78B0 ON planning (cours_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours_categories DROP FOREIGN KEY FK_3F0BB4417ECF78B0');
        $this->addSql('ALTER TABLE cours_categories DROP FOREIGN KEY FK_3F0BB441A21214B7');
        $this->addSql('DROP TABLE cours_categories');
        $this->addSql('ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF67ECF78B0');
        $this->addSql('DROP INDEX IDX_D499BFF67ECF78B0 ON planning');
        $this->addSql('ALTER TABLE planning DROP cours_id');
    }
}
