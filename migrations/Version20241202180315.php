<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241202180315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Attribut Evolution';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon ADD devolution_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F37714117F FOREIGN KEY (devolution_id) REFERENCES pokemon (id)');
        $this->addSql('CREATE INDEX IDX_62DC90F37714117F ON pokemon (devolution_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F37714117F');
        $this->addSql('DROP INDEX IDX_62DC90F37714117F ON pokemon');
        $this->addSql('ALTER TABLE pokemon DROP devolution_id');
    }
}
