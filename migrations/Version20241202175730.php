<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241202175730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creation Category + relation ManyToMany with Pokemon';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pokemon_category (pokemon_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_8128D06F2FE71C3E (pokemon_id), INDEX IDX_8128D06F12469DE2 (category_id), PRIMARY KEY(pokemon_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pokemon_category ADD CONSTRAINT FK_8128D06F2FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon_category ADD CONSTRAINT FK_8128D06F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon_category DROP FOREIGN KEY FK_8128D06F2FE71C3E');
        $this->addSql('ALTER TABLE pokemon_category DROP FOREIGN KEY FK_8128D06F12469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE pokemon_category');
    }
}
