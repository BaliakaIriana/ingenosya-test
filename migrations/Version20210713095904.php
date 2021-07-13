<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210713095904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE code_postal DROP FOREIGN KEY FK_CC94AC377E841BEA');
        $this->addSql('DROP INDEX IDX_CC94AC377E841BEA ON code_postal');
        $this->addSql('ALTER TABLE code_postal DROP societes_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE code_postal ADD societes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE code_postal ADD CONSTRAINT FK_CC94AC377E841BEA FOREIGN KEY (societes_id) REFERENCES societe (id)');
        $this->addSql('CREATE INDEX IDX_CC94AC377E841BEA ON code_postal (societes_id)');
    }
}
